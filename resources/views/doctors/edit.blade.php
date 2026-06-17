@extends('adminlte::page')

@section('title','Edit Doctor')

@section('content')

<div class="container-fluid mt-3">

<div class="card card-primary card-outline shadow-sm">

{{-- HEADER --}}
<div class="card-header">
<div class="d-flex justify-content-between">
<h3 class="mb-0">
<i class="fas fa-user-md text-primary"></i>
Edit Doctor
</h3>
<span class="badge badge-warning">Doctor Update</span>
</div>
</div>

<form method="POST" action="{{ route('doctors.update', $doctor->id) }}">
@csrf
@method('PUT')

<div class="card-body">

{{-- BASIC INFO --}}
<div class="card card-outline card-info mb-3">
<div class="card-header">
<h5><i class="fas fa-id-card"></i> Basic Information</h5>
</div>

<div class="card-body">
<div class="row">

<div class="col-md-4">
<label>Doctor Code</label>
<input type="text" name="doctor_code" class="form-control"
value="{{ old('doctor_code', $doctor->doctor_code) }}">
</div>

<div class="col-md-4">
<label>Doctor Name *</label>
<input type="text" name="doctor_name" class="form-control" required
value="{{ old('doctor_name', $doctor->doctor_name) }}">
</div>

<div class="col-md-4">
<label>Department *</label>
<select name="department_id" class="form-control" required>
<option value="">Select</option>
@foreach($departments as $dept)
<option value="{{ $dept->id }}"
{{ old('department_id', $doctor->department_id) == $dept->id ? 'selected' : '' }}>
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
<h5><i class="fas fa-stethoscope"></i> Professional Details</h5>
</div>

<div class="card-body">
<div class="row">

<div class="col-md-4">
<label>Specialization</label>
<input type="text" name="specialization" class="form-control"
value="{{ old('specialization', $doctor->specialization) }}">
</div>

<div class="col-md-4">
<label>Qualification</label>
<input type="text" name="qualification" class="form-control"
value="{{ old('qualification', $doctor->qualification) }}">
</div>

<div class="col-md-4">
<label>Registration No</label>
<input type="text" name="registration_no" class="form-control"
value="{{ old('registration_no', $doctor->registration_no) }}">
</div>

</div>
</div>
</div>

{{-- CONTACT --}}
<div class="card card-outline card-warning mb-3">
<div class="card-header">
<h5><i class="fas fa-phone"></i> Contact</h5>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">
<label>Mobile</label>
<input type="text" name="mobile" class="form-control"
value="{{ old('mobile', $doctor->mobile) }}">
</div>

<div class="col-md-4">
<label>Email</label>
<input type="email" name="email" class="form-control"
value="{{ old('email', $doctor->email) }}">
</div>

<div class="col-md-4">
<label>Consultation Fee</label>
<input type="number" name="consultation_fee" class="form-control"
value="{{ old('consultation_fee', $doctor->consultation_fee) }}">
</div>

</div>

<div class="row mt-3">

<div class="col-md-6">
<label>Followup Fee</label>
<input type="number" name="followup_fee" class="form-control"
value="{{ old('followup_fee', $doctor->followup_fee) }}">
</div>

<div class="col-md-6">
<label>Status</label>
<select name="status" class="form-control">
<option value="1"
{{ old('status', $doctor->status) == 1 ? 'selected' : '' }}>
Active
</option>
<option value="0"
{{ old('status', $doctor->status) == 0 ? 'selected' : '' }}>
Inactive
</option>
</select>
</div>

</div>

</div>
</div>

</div>

<div class="card-footer text-right">

<a href="{{ route('doctors.index') }}" class="btn btn-secondary">
Cancel
</a>

<button class="btn btn-success">
<i class="fas fa-save"></i> Update Doctor
</button>

</div>

</form>

</div>

</div>

@stop