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
])->latest();

return DataTables::of($visits)

->addIndexColumn()

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


// 🔄 CREATE FROM APPOINTMENT (MAIN FLOW)


public function createFromAppointment($appointmentId)
{
$appointment = Appointment::with([
'patient',
'doctor'
])->findOrFail($appointmentId);

// Allow only on appointment date

if ($appointment->appointment_date != now()->toDateString()) {

return redirect()
->route('appointments.index')
->with(
'error',
'OPD Check-In is allowed only on appointment date.'
);
}

// Already checked-in ?

$existingVisit = OpdVisit::where(
'appointment_id',
$appointment->id
)->first();

if ($existingVisit) {

return redirect()
->route('opd.index')
->with(
'error',
'Patient already checked-in.'
);
}

// Create OPD Visit

$visit = OpdVisit::create([

'visit_no' =>
'OPD' .
date('Ymd') .
str_pad(
OpdVisit::count() + 1,
4,
'0',
STR_PAD_LEFT
),

'appointment_id' =>
$appointment->id,

'patient_id' =>
$appointment->patient_id,

'doctor_id' =>
$appointment->doctor_id,

// Important

'visit_date' =>
$appointment->appointment_date,

'status' =>
'In Queue',

'notes' =>
null,

]);

// Appointment Status Update

$appointment->update([

'status' => 'Checked In'

]);

return redirect()
->route('opd.index')
->with(
'success',
'OPD Check-In completed successfully.'
);
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
'consultation.labOrders.test'
])->findOrFail($id);

return view('opd.show', compact('visit'));
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