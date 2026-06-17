@extends('adminlte::page')

@section('title', 'Doctor Master')

@section('content')

<div class="container-fluid mt-3">

<div class="card card-primary card-outline shadow-sm">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-user-md"></i> Add New Doctor
</h3>
</div>

<form action="{{ route('doctors.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="card-body">

@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

{{-- BASIC INFO --}}
<div class="card card-outline card-info mb-3">
<div class="card-header">
<h5 class="mb-0">Basic Information</h5>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">
<label>Doctor Code</label>
<input type="text"
name="doctor_code"
class="form-control"
value="{{ old('doctor_code') }}">
</div>

<div class="col-md-4">
<label>Doctor Name <span class="text-danger">*</span></label>
<input type="text"
name="doctor_name"
class="form-control"
value="{{ old('doctor_name') }}"
required>
</div>

<div class="col-md-4">
<label>Department <span class="text-danger">*</span></label>
<select name="department_id"
class="form-control"
required>

<option value="">Select Department</option>

@foreach($departments as $dept)
<option value="{{ $dept->id }}">
{{ $dept->name }}
</option>
@endforeach

</select>
</div>

</div>

</div>
</div>

{{-- PROFESSIONAL INFO --}}
<div class="card card-outline card-success mb-3">
<div class="card-header">
<h5 class="mb-0">Professional Details</h5>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">
<label>Specialization</label>
<input type="text"
name="specialization"
class="form-control">
</div>

<div class="col-md-4">
<label>Qualification</label>
<input type="text"
name="qualification"
class="form-control">
</div>

<div class="col-md-4">
<label>Registration No</label>
<input type="text"
name="registration_no"
class="form-control">
</div>

</div>

</div>
</div>

{{-- CONTACT --}}
<div class="card card-outline card-warning mb-3">
<div class="card-header">
<h5 class="mb-0">Contact Information</h5>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">
<label>Mobile</label>
<input type="text"
name="mobile"
class="form-control">
</div>

<div class="col-md-4">
<label>Email</label>
<input type="email"
name="email"
class="form-control">
</div>

<div class="col-md-4">
<label>Address</label>
<input type="text"
name="address"
class="form-control">
</div>

</div>

</div>
</div>

{{-- FEES --}}
<div class="card card-outline card-primary mb-3">
<div class="card-header">
<h5 class="mb-0">Consultation Fees</h5>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">
<label>Consultation Fee</label>
<input type="number"
step="0.01"
name="consultation_fee"
class="form-control">
</div>

<div class="col-md-4">
<label>Followup Fee</label>
<input type="number"
step="0.01"
name="followup_fee"
class="form-control">
</div>

<div class="col-md-4">
<label>Status</label>
<select name="status"
class="form-control">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

</div>

</div>
</div>

{{-- FILES --}}
<div class="card card-outline card-secondary mb-3">
<div class="card-header">
<h5 class="mb-0">Photo & Signature</h5>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">
<label>Doctor Photo</label>
<input type="file"
name="photo"
class="form-control">
</div>

<div class="col-md-6">
<label>Doctor Signature</label>
<input type="file"
name="signature"
class="form-control">
</div>

</div>

</div>
</div>

{{-- LOGIN ACCOUNT --}}
<div class="card card-outline card-danger">
<div class="card-header">
<h5 class="mb-0">Login Account</h5>
</div>

<div class="card-body">

<div class="form-check">
<input class="form-check-input"
type="checkbox"
name="create_login"
value="1"
checked>

<label class="form-check-label">
Create Login Account for Doctor
</label>
</div>

<small class="text-muted">
Default Password: <b>123456</b>
</small>

</div>
</div>

</div>

<div class="card-footer text-right">

<a href="{{ route('doctors.index') }}"
class="btn btn-secondary">
Cancel
</a>

<button type="submit"
class="btn btn-success">
<i class="fas fa-save"></i>
Save Doctor
</button>

</div>

</form>

</div>

</div>

@stop