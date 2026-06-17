<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
public function index(Request $request)
{
if ($request->ajax()) {

$doctors = Doctor::latest();

return DataTables::of($doctors)

->addIndexColumn()

->addColumn('department', function ($doctor) {
return $doctor->department->name ?? '-';
})

->addColumn('action', function ($doctor) {

$btn = '';

// View
$btn .= '
<a href="'.route('doctors.show', $doctor->id).'"
class="btn btn-info btn-sm">
View
</a> ';

// Edit
$btn .= '
<a href="'.route('doctors.edit', $doctor->id).'"
class="btn btn-warning btn-sm">
Edit
</a> ';

// Delete
$btn .= '
<form action="'.route('doctors.destroy', $doctor->id).'"
method="POST"
style="display:inline">

'.csrf_field().'
'.method_field('DELETE').'

<button class="btn btn-danger btn-sm"
onclick="return confirm(\'Delete Doctor?\')">
Delete
</button>

</form>';

return $btn;
})

->rawColumns(['action'])

->make(true);
}

return view('doctors.index');
}

public function create()
{

$departments = Department::latest()->get(); 
return view('doctors.create', compact('departments'));
}



public function store(Request $request)
{
$request->validate([
'doctor_name'   => 'required|string|max:255',
'department_id' => 'required|exists:departments,id',
'email'         => 'nullable|email|unique:doctors,email',
'photo'         => 'nullable|image',
'signature'     => 'nullable|image',
]);

$userId = null;

// Create Login Account
if ($request->create_login && $request->email) {

$user = User::create([
'name'     => $request->doctor_name,
'email'    => $request->email,
'password' => Hash::make('123456'),
'role_id'  => 4, // Doctor Role
]);

$userId = $user->id;
}

$photo = null;
if ($request->hasFile('photo')) {
$photo = $request->file('photo')
->store('doctors/photos', 'public');
}

$signature = null;
if ($request->hasFile('signature')) {
$signature = $request->file('signature')
->store('doctors/signatures', 'public');
}

Doctor::create([

'doctor_code' =>
'DOC-' . now()->format('YmdHis'),

'user_id' =>
$userId,

'department_id' =>
$request->department_id,

'doctor_name' =>
$request->doctor_name,

'specialization' =>
$request->specialization,

'qualification' =>
$request->qualification,

'registration_no' =>
$request->registration_no,

'mobile' =>
$request->mobile,

'email' =>
$request->email,

'address' =>
$request->address,

'consultation_fee' =>
$request->consultation_fee ?? 0,

'followup_fee' =>
$request->followup_fee ?? 0,

'photo' =>
$photo,

'signature' =>
$signature,

'status' =>
$request->status ?? 1,
]);

return redirect()
->route('doctors.index')
->with(
'success',
'Doctor Added Successfully'
);
}




public function show(Doctor $doctor)
{

$departments = Department::latest()->get(); 
return view('doctors.show', compact('doctor', 'departments'));
}

public function edit(Doctor $doctor)
{

$departments = Department::latest()->get(); 
return view('doctors.edit', compact('doctor','departments'));
}

public function update(Request $request, Doctor $doctor)
{
$request->validate([
'doctor_name' => 'required',
'department_id' => 'required',
]);

$doctor->update([
'doctor_code' => $request->doctor_code,
'doctor_name' => $request->doctor_name,
'department_id' => $request->department_id,
'specialization' => $request->specialization,
'qualification' => $request->qualification,
'registration_no' => $request->registration_no,
'mobile' => $request->mobile,
'email' => $request->email,
'consultation_fee' => $request->consultation_fee,
'followup_fee' => $request->followup_fee,
'status' => $request->status ?? 1,
]);

return redirect()
->route('doctors.index')
->with('success', 'Doctor Updated Successfully');
}

public function destroy(Doctor $doctor)
{
$doctor->delete();

return redirect()
->route('doctors.index')
->with('success', 'Doctor Deleted Successfully');
}



}