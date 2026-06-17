@extends('adminlte::page')

@section('title','Edit Patient')

@section('content')

<div class="card mt-3 card-outline card-warning">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-user-edit"></i>
Edit Patient
</h3>
</div>

<form action="{{ route('patients.update',$patient->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="card-body">

<div class="row">

<div class="col-md-4">
<label>UHID</label>
<input type="text"
class="form-control"
value="{{ $patient->uhid }}"
readonly>
</div>

<div class="col-md-8">
<label>Patient Name</label>
<input type="text"
name="patient_name"
value="{{ $patient->patient_name }}"
class="form-control">
</div>

</div>

<div class="row mt-3">

<div class="col-md-3">
<label>Gender</label>
<select name="gender" class="form-control">

<option value="Male"
{{ $patient->gender=='Male'?'selected':'' }}>
Male
</option>

<option value="Female"
{{ $patient->gender=='Female'?'selected':'' }}>
Female
</option>

<option value="Other"
{{ $patient->gender=='Other'?'selected':'' }}>
Other
</option>

</select>
</div>

<div class="col-md-3">
<label>Age</label>
<input type="number"
name="age"
value="{{ $patient->age }}"
class="form-control">
</div>

<div class="col-md-3">
<label>DOB</label>
<input type="date"
name="dob"
value="{{ $patient->dob }}"
class="form-control">
</div>

<div class="col-md-3">
<label>Blood Group</label>
<input type="text"
name="blood_group"
value="{{ $patient->blood_group }}"
class="form-control">
</div>

</div>

<div class="row mt-3">

<div class="col-md-4">
<label>Mobile</label>
<input type="text"
name="mobile"
value="{{ $patient->mobile }}"
class="form-control">
</div>

<div class="col-md-4">
<label>Emergency Contact</label>
<input type="text"
name="emergency_contact"
value="{{ $patient->emergency_contact }}"
class="form-control">
</div>

<div class="col-md-4">
<label>Email</label>
<input type="email"
name="email"
value="{{ $patient->email }}"
class="form-control">
</div>

</div>

<div class="row mt-3">

<div class="col-md-4">
<label>City</label>
<input type="text"
name="city"
value="{{ $patient->city }}"
class="form-control">
</div>

<div class="col-md-4">
<label>State</label>
<input type="text"
name="state"
value="{{ $patient->state }}"
class="form-control">
</div>

<div class="col-md-4">
<label>Pincode</label>
<input type="text"
name="pincode"
value="{{ $patient->pincode }}"
class="form-control">
</div>

</div>

<div class="mt-3">
<label>Address</label>

<textarea name="address"
rows="3"
class="form-control">{{ $patient->address }}</textarea>
</div>

</div>

<div class="card-footer text-right">

<a href="{{ route('patients.index') }}"
class="btn btn-secondary">
Cancel
</a>

<button class="btn btn-warning">
<i class="fas fa-save"></i>
Update Patient
</button>

</div>

</form>

</div>

@stop