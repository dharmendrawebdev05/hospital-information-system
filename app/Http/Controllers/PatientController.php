<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
/**
* LISTING (YAJRA)
*/
public function index(Request $request)
{
if ($request->ajax()) {

$data = Patient::select([
'id',
'uhid',
'patient_name',
'mobile',
'gender'
]);

return DataTables::of($data)

->addColumn('action', function($row){

return '
<a href="'.route('patients.show',$row->id).'" class="btn btn-info btn-sm">View</a>
<a href="'.route('patients.edit',$row->id).'" class="btn btn-warning btn-sm">Edit</a>
';
})

->rawColumns(['action'])
->make(true);
}

return view('patients.index');
}

/**
* CREATE
*/
public function create()
{
return view('patients.create');
}

/**
* STORE
*/
public function store(Request $request)
{
$validated = $request->validate([
'patient_name'      => 'required|string|max:255',
'mobile'            => 'required|string|max:15',
'gender'            => 'required',
'age'               => 'required|integer|min:0|max:150',

'dob'               => 'nullable|date',
'blood_group'       => 'nullable|string|max:5',
'marital_status'    => 'nullable|string|max:50',
'patient_type'      => 'nullable|string|max:50',

'emergency_contact' => 'nullable|string|max:15',
'email'             => 'nullable|email|max:255',

'city'              => 'nullable|string|max:100',
'state'             => 'nullable|string|max:100',
'pincode'           => 'nullable|string|max:10',

'address'           => 'nullable|string',

'aadhaar_no'        => 'nullable|string|max:20',
'occupation'        => 'nullable|string|max:255',
]);

$patient = Patient::create([
'patient_name'      => $validated['patient_name'],
'mobile'            => $validated['mobile'],
'gender'            => $validated['gender'],
'age'               => $validated['age'],

'dob'               => $validated['dob'] ?? null,
'blood_group'       => $validated['blood_group'] ?? null,
'marital_status'    => $validated['marital_status'] ?? null,
'patient_type'      => $validated['patient_type'] ?? 'General',

'emergency_contact' => $validated['emergency_contact'] ?? null,
'email'             => $validated['email'] ?? null,

'city'              => $validated['city'] ?? null,
'state'             => $validated['state'] ?? null,
'pincode'           => $validated['pincode'] ?? null,

'address'           => $validated['address'] ?? null,

'aadhaar_no'        => $validated['aadhaar_no'] ?? null,
'occupation'        => $validated['occupation'] ?? null,
]);

// Generate UHID after patient creation
$patient->update([
'uhid' => 'UHID' . date('Ymd') . str_pad($patient->id, 5, '0', STR_PAD_LEFT)
]);

return redirect()
->route('patients.index')
->with('success', 'Patient Registered Successfully');
}






/**
* SHOW
*/
public function show(Patient $patient)
{
return view('patients.show', compact('patient'));
}

/**
* EDIT
*/
public function edit(Patient $patient)
{
return view('patients.edit', compact('patient'));
}

/**
* UPDATE
*/
public function update(Request $request, Patient $patient)
{
$patient->update($request->all());

return redirect()->route('patients.index')
->with('success','Patient Updated Successfully');
}

/**
* DELETE
*/
public function destroy(Patient $patient)
{
$patient->delete();

return redirect()->route('patients.index')
->with('success','Patient Deleted Successfully');
}
}