<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IpdAdmission;
use App\Models\OpdVisit;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Ward;
use App\Models\Bed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class IpdAdmissionController extends Controller
{
/**
* Admission Form
*/


public function create(OpdVisit $visit)
{
// Already admitted check
$existingAdmission = IpdAdmission::where(
'opd_visit_id',
$visit->id
)->first();

if ($existingAdmission) {

return redirect()
->back()
->with(
'error',
'Patient already admitted.'
);
}

$beds = Bed::with('ward')
->where('status', 'Available')
->orderBy('bed_no')
->get();

return view(
'ipd.admissions.create',
compact('visit', 'beds')
);
}

/**
* Save Admission
*/

public function store(Request $request)
{
$request->validate([
'opd_visit_id' => 'required|exists:opd_visits,id',
'patient_id' => 'required|exists:patients,id',
'doctor_id' => 'required|exists:doctors,id',
'bed_id' => 'required|exists:beds,id',
'source' => 'required',
'admission_date' => 'required|date',
'admission_time' => 'required',
]);

try {

$admission = DB::transaction(function () use ($request) {

$bed = Bed::where('id', $request->bed_id)
->lockForUpdate()
->firstOrFail();

if ($bed->status !== 'Available') {
throw new \Exception('Selected bed is not available.');
}

$admissionNo = 'IPD-' . date('Ymd') . '-' . str_pad(
IpdAdmission::max('id') + 1,
4,
'0',
STR_PAD_LEFT
);

$admission = IpdAdmission::create([
'admission_no' => $admissionNo,
'opd_visit_id' => $request->opd_visit_id,
'patient_id' => $request->patient_id,
'doctor_id' => $request->doctor_id,
'bed_id' => $request->bed_id,
'source' => $request->source,
'admission_date' => $request->admission_date,
'admission_time' => $request->admission_time,
'reason' => $request->reason,
'remarks' => $request->remarks,
'status' => 'Admitted',
]);

$bed->update([
'status' => 'Occupied'
]);

return $admission;
});

return redirect()
->route('ipd.admissions.index')
->with('success', 'Patient admitted successfully.');

} catch (\Exception $e) {

return back()->with('error', $e->getMessage());
}
}

/**
* Active IPD Patients
*/

public function index(Request $request)
{
if ($request->ajax()) {

$data = IpdAdmission::with(['patient','doctor','bed.ward']);

return DataTables::of($data)
->addIndexColumn()

->addColumn('patient', function($row){
return $row->patient->patient_name ?? '-';
})

->addColumn('doctor', function($row){
return $row->doctor->doctor_name ?? '-';
})

->addColumn('ward', function($row){
return $row->bed->ward->ward_name ?? '-';
})

->addColumn('bed', function($row){
return $row->bed->bed_no ?? '-';
})

->editColumn('status', function($row){

if ($row->status == 'Admitted') {
return '<span class="badge badge-success">Admitted</span>';
}

if ($row->status == 'Discharged') {
return '<span class="badge badge-secondary">Discharged</span>';
}

return '<span class="badge badge-warning">'.$row->status.'</span>';
})

->addColumn('action', function($row){

return '
<a href="'.route('ipd.admissions.show',$row->id).'" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
<a href="'.route('ipd.admissions.edit',$row->id).'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
<form method="POST" action="'.route('ipd.admissions.destroy',$row->id).'" style="display:inline">
'.csrf_field().'
'.method_field("DELETE").'
<button class="btn btn-danger btn-sm" onclick="return confirm(\'Delete this admission?\')">
<i class="fas fa-trash"></i>
</button>
</form>';
})

->rawColumns(['status','action'])
->make(true);
}

return view('ipd.admissions.index');
}


/**
* Admission Details
*/
public function show(IpdAdmission $admission)
{
$admission->load([
'patient',
'doctor',
'bed.ward',
'opdVisit'
]);

return view(
'ipd.admissions.show',
compact('admission')
);
}


public function edit($id)
{
$admission = IpdAdmission::findOrFail($id);

$patients = Patient::all();
$doctors = Doctor::all();
$wards = Ward::all();
$beds = Bed::all();
$selectedWardId = $admission->bed?->ward_id;

return view('ipd.admissions.edit', compact(
'admission',
'patients',
'doctors',
'wards',
'beds',
'selectedWardId'
));
}


public function update(Request $request, $id)
{
$admission = IpdAdmission::findOrFail($id);

$request->validate([
'patient_id' => 'required',
'doctor_id' => 'required',
'ward_id' => 'required',
'bed_id' => 'required',
'admission_date' => 'required|date',
]);

$admission->update([
'patient_id' => $request->patient_id,
'doctor_id' => $request->doctor_id,
'ward_id' => $request->ward_id,
'bed_id' => $request->bed_id,
'admission_date' => $request->admission_date,
'reason' => $request->reason,
'remarks' => $request->remarks,
'status' => $request->status,
]);

return redirect()
->route('ipd.admissions.index')
->with('success', 'Admission updated successfully.');
}

public function print($id)
{
$admission = IpdAdmission::with([
'patient',
'doctor',
'bed.ward'
])->findOrFail($id);

return view('ipd.admissions.print', compact('admission'));
}

}