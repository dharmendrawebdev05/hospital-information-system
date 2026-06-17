@extends('adminlte::page')

@section('title', 'Edit IPD Admission')

@section('content_header')
<h1>Edit IPD Admission</h1>
@stop

@section('content')

<div class="card mt-3  card-outline card-primary">
<div class="card-header">
<h3 class="card-title">
Admission No: {{ $admission->admission_no }}
</h3>
</div>

<form action="{{ route('ipd.admissions.update', $admission->id) }}"
method="POST">

@csrf
@method('PUT')

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

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Patient <span class="text-danger">*</span></label>

<select name="patient_id" class="form-control" required>
<option value="">Select Patient</option>

@foreach($patients as $patient)
<option value="{{ $patient->id }}"
{{ $admission->patient_id == $patient->id ? 'selected' : '' }}>
{{ $patient->patient_name }}
</option>
@endforeach
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Doctor <span class="text-danger">*</span></label>

<select name="doctor_id" class="form-control" required>
<option value="">Select Doctor</option>

@foreach($doctors as $doctor)
<option value="{{ $doctor->id }}"
{{ $admission->doctor_id == $doctor->id ? 'selected' : '' }}>
{{ $doctor->doctor_name }}
</option>
@endforeach
</select>
</div>
</div>

</div>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>Ward <span class="text-danger">*</span></label>

<select name="ward_id" class="form-control">
    @foreach($wards as $ward)
        <option value="{{ $ward->id }}"
            {{ $selectedWardId == $ward->id ? 'selected' : '' }}>
            {{ $ward->ward_name }}
        </option>
    @endforeach
</select>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Bed <span class="text-danger">*</span></label>

<select name="bed_id" class="form-control" required>
<option value="">Select Bed</option>

@foreach($beds as $bed)
<option value="{{ $bed->id }}"
{{ $admission->bed_id == $bed->id ? 'selected' : '' }}>
{{ $bed->bed_no }}
</option>
@endforeach
</select>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Admission Date</label>

<input type="date"
name="admission_date"
class="form-control"
value="{{ old('admission_date', date('Y-m-d', strtotime($admission->admission_date))) }}"
required>

</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Reason</label>

<textarea name="diagnosis"
class="form-control"
rows="4">{{ old('reason', $admission->reason) }}</textarea>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Remarks</label>

<textarea name="remarks"
class="form-control"
rows="4">{{ old('remarks', $admission->remarks) }}</textarea>
</div>
</div>

</div>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>Status</label>

<select name="status" class="form-control">

<option value="Admitted"
{{ $admission->status == 'Admitted' ? 'selected' : '' }}>
Admitted
</option>

<option value="Discharged"
{{ $admission->status == 'Discharged' ? 'selected' : '' }}>
Discharged
</option>

<option value="Transferred"
{{ $admission->status == 'Transferred' ? 'selected' : '' }}>
Transferred
</option>

</select>
</div>
</div>

</div>

</div>

<div class="card-footer">

<button type="submit" class="btn btn-primary">
<i class="fas fa-save"></i> Update Admission
</button>

<a href="{{ route('ipd.admissions.index') }}"
class="btn btn-secondary">
Cancel
</a>

</div>

</form>

</div>

@stop