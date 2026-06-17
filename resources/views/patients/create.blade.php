@extends('adminlte::page')

@section('title','Patient Registration')

@section('content')

<div class="card mt-3 card-outline card-primary">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-user-plus"></i>
Patient Registration
</h3>
</div>

@if($errors->any())
<div class="alert alert-danger m-3">
<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ route('patients.store') }}"
method="POST">

@csrf

<div class="card-body">

<!-- Patient Information -->

<div class="card card-outline card-info">

<div class="card-header">
<h5 class="mb-0">Patient Information</h5>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">
<label>Patient Name *</label>
<input type="text"
name="patient_name"
class="form-control"
required>
</div>

<div class="col-md-3">
<label>Gender *</label>

<select name="gender"
class="form-control"
required>

<option value="">Select</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>

</select>

</div>

<div class="col-md-3">
<label>Age *</label>

<input type="number"
name="age"
class="form-control"
required>
</div>

</div>

<div class="row mt-3">

<div class="col-md-3">
<label>Date of Birth</label>

<input type="date"
name="dob"
class="form-control">
</div>

<div class="col-md-3">

<label>Blood Group</label>

<select name="blood_group"
class="form-control">

<option value="">Select</option>

<option>A+</option>
<option>A-</option>
<option>B+</option>
<option>B-</option>
<option>AB+</option>
<option>AB-</option>
<option>O+</option>
<option>O-</option>

</select>

</div>

<div class="col-md-3">

<label>Marital Status</label>

<select name="marital_status"
class="form-control">

<option value="">Select</option>
<option>Single</option>
<option>Married</option>
<option>Widowed</option>

</select>

</div>

<div class="col-md-3">

<label>Patient Type</label>

<select name="patient_type"
class="form-control">

<option>General</option>
<option>Corporate</option>
<option>Insurance</option>

</select>

</div>

</div>

</div>

</div>

<!-- Contact Information -->

<div class="card card-outline card-success mt-3">

<div class="card-header">
<h5 class="mb-0">Contact Information</h5>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">

<label>Mobile *</label>

<input type="text"
name="mobile"
class="form-control"
required>

</div>

<div class="col-md-4">

<label>Emergency Contact</label>

<input type="text"
name="emergency_contact"
class="form-control">

</div>

<div class="col-md-4">

<label>Email</label>

<input type="email"
name="email"
class="form-control">

</div>

</div>

<div class="row mt-3">

<div class="col-md-4">

<label>City</label>

<input type="text"
name="city"
class="form-control">

</div>

<div class="col-md-4">

<label>State</label>

<input type="text"
name="state"
class="form-control">

</div>

<div class="col-md-4">

<label>Pincode</label>

<input type="text"
name="pincode"
class="form-control">

</div>

</div>

<div class="row mt-3">

<div class="col-md-12">

<label>Address</label>

<textarea name="address"
rows="3"
class="form-control"></textarea>

</div>

</div>

</div>

</div>

<!-- Identification -->

<div class="card card-outline card-warning mt-3">

<div class="card-header">
<h5 class="mb-0">Identification</h5>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<label>Aadhaar No</label>

<input type="text"
name="aadhaar_no"
class="form-control">

</div>

<div class="col-md-6">

<label>Occupation</label>

<input type="text"
name="occupation"
class="form-control">

</div>

</div>

</div>

</div>

<!-- UHID Notice -->

<div class="alert alert-info mt-3">

<i class="fas fa-info-circle"></i>

UHID will be generated automatically after registration.

</div>

</div>

<div class="card-footer text-right">

<a href="{{ route('patients.index') }}"
class="btn btn-secondary">

Cancel

</a>

<button type="submit"
class="btn btn-success">

<i class="fas fa-user-plus"></i>

Register Patient

</button>

</div>

</form>

</div>

@stop