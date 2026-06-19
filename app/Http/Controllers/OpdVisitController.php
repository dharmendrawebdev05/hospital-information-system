<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpdVisit;
use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\LabTest;
use App\Models\LabOrder;
use App\Models\Procedure;
use App\Models\RadiologyTest;
use Yajra\DataTables\Facades\DataTables;


class OpdVisitController extends Controller
{

public function index(Request $request)
{
if ($request->ajax()) {

$visits = OpdVisit::with([
'patient',
'doctor',
'appointment.patient',
'appointment.doctor'
]);

if(auth()->user()->hasRole('Doctor')) {

$visits->where('doctor_id', auth()->user()->doctor->id);
}
$visits = $visits->latest();


return DataTables::of($visits)

->addIndexColumn()


->addColumn('token_no', function ($row) {
return $row->token_no ?? '-';
})


->addColumn('patient_name', function ($row) {
return optional($row->patient)->patient_name ?? '-';
})

->addColumn('doctor_name', function ($row) {
return optional($row->doctor)->doctor_name ?? '-';
})

// Patient Search
->filterColumn('patient_name', function ($query, $keyword) {
$query->whereHas('patient', function ($q) use ($keyword) {
$q->where('patient_name', 'like', "%{$keyword}%");
});
})

// Doctor Search
->filterColumn('doctor_name', function ($query, $keyword) {
$query->whereHas('doctor', function ($q) use ($keyword) {
$q->where('doctor_name', 'like', "%{$keyword}%");
});
})

->addColumn('status_badge', function ($visit) {

if ($visit->status == 'Waiting') {
return '<span class="badge badge-warning">Waiting</span>';
}

if ($visit->status == 'In Queue') {
return '<span class="badge badge-warning">In Queue</span>';
}

if ($visit->status == 'In Consultation') {
return '<span class="badge badge-primary">In Consultation</span>';
}

if ($visit->status == 'Completed') {
return '<span class="badge badge-success">Completed</span>';
}

return '-';
})

->addColumn('action', function ($visit) {

$btn = '';

if ($visit->status == 'In Queue') {

$btn .= '
<a href="' . route('opd.start', $visit->id) . '"
class="btn btn-success btn-sm">
Start
</a>';
}

elseif ($visit->status == 'In Consultation') {

$btn .= '
<a href="' . route('opd.consult', $visit->id) . '"
class="btn btn-primary btn-sm">
Continue
</a>';
}

elseif ($visit->status == 'Completed') {

$btn .= '
<a href="' . route('opd.show', $visit->id) . '"
class="btn btn-info btn-sm">
View
</a>

<a href="' . route('opd.print', $visit->id) . '"
target="_blank"
class="btn btn-primary btn-sm">
Print
</a>';
}

return $btn;
})

->rawColumns([
'status_badge',
'action'
])

->make(true);
}

return view('opd.index');
}


public function createFromAppointment($appointmentId)
{
$appointment = Appointment::with(['patient','doctor'])
->findOrFail($appointmentId);

// ================= DATE CHECK =================
if ($appointment->appointment_date != now()->toDateString()) {
return response()->json([
'status' => false,
'message' => 'OPD Check-In allowed only on appointment date.'
]);
}

// ================= ALREADY CHECKED-IN =================
$existingVisit = OpdVisit::where('appointment_id', $appointment->id)->first();

if ($existingVisit) {
return response()->json([
'status' => false,
'message' => 'Patient already checked-in.'
]);
}

// ================= TOKEN GENERATION =================
$tokenNo = OpdVisit::where('doctor_id', $appointment->doctor_id)
->whereDate('visited_at', now()->toDateString())
->max('token_no');

$tokenNo = $tokenNo ? $tokenNo + 1 : 1;

// ================= CREATE OPD VISIT =================
$visit = OpdVisit::create([
'visit_no' => 'OPD' . date('Ymd') . str_pad(OpdVisit::count() + 1, 4, '0', STR_PAD_LEFT),

'appointment_id' => $appointment->id,
'patient_id'     => $appointment->patient_id,
'doctor_id'      => $appointment->doctor_id,

'token_no'       => $tokenNo,
'visited_at'     => now(),
'status'         => 'In Queue',
'notes'          => null,
]);

// ================= UPDATE APPOINTMENT =================
$appointment->update([
'status' => 'Checked In'
]);

// ================= RESPONSE =================
return response()->json([
'status' => true,
'message' => 'OPD Check-In successful',
'data' => [
'token_no' => $tokenNo,
'visit_no' => $visit->visit_no,
'patient'  => $appointment->patient->patient_name,
'doctor'   => $appointment->doctor->doctor_name,
]
]);
}


public function printToken($visitId)
{
$visit = OpdVisit::with([
'patient',
'doctor',
'appointment'
])->findOrFail($visitId);

return response()->json([
'status' => true,
'data' => [
'token_no' => $visit->token_no,
'visit_no' => $visit->visit_no,
'patient'  => optional($visit->patient)->patient_name,
'doctor'   => optional($visit->doctor)->doctor_name,
]
]);
}




// 👨‍⚕️ START CONSULTATION
public function startConsultation($id)
{
$visit = OpdVisit::findOrFail($id);

$visit->update([
'status' => 'In Consultation'
]);

return redirect()->route('opd.consult', $visit->id);
}


public function consult($id)
{
$visit = OpdVisit::with(['patient','doctor'])
->findOrFail($id);

$medicines = Medicine::orderBy('medicine_name')
->get();

$labTests = LabTest::orderBy('test_name')
->get(); 

$procedures = Procedure::orderBy('procedure_name')
->get();  

$radiologyTests = RadiologyTest::orderBy('test_name')
->get();   


return view('opd.consult', compact(
'visit',
'medicines',
'labTests',
'procedures',
'radiologyTests'
));
}


// ✅ COMPLETE VISIT
public function complete($id)
{
$visit = OpdVisit::findOrFail($id);

$visit->update([
'status' => 'Completed'
]);

return redirect()->route('opd.index')
->with('success', 'Visit completed successfully');
}


// 👁️ SHOW VISIT
public function show($id)
{
$visit = OpdVisit::with([
'patient',
'doctor',
'consultation.prescriptions.medicine',
'consultation.labOrders.labTest'
])->findOrFail($id);


$previousVisits = OpdVisit::with([
    'doctor',
    'consultation'
])
->where('patient_id', $visit->patient_id)
->where('id', '!=', $visit->id)
->whereIn('status', [
    'Completed',
    'Followup'
    
])
->latest('visited_at')
->get();


return view('opd.show', compact('visit', 'previousVisits'));
}


public function print($id)
{
$visit = OpdVisit::with([
'patient',
'doctor',
'consultation',
'consultation.prescriptions.medicine',
'consultation.labOrders.test'
])->findOrFail($id);

return view('opd.print', compact('visit'));
}




}