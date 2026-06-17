@extends('adminlte::page')

@section('title','IPD Admission')

@section('content')

<div class="container-fluid mt-3">

<!-- ================= PAGE HEADER ================= -->
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">IPD Admission</h4>
<small class="text-muted">Admit patient to inpatient department</small>
</div>

<a href="{{ route('opd.show', $visit->id) }}" class="btn btn-outline-secondary btn-sm">
← Back
</a>
</div>

<form method="POST" action="{{ route('ipd.admissions.store') }}">
@csrf

<input type="hidden" name="opd_visit_id" value="{{ $visit->id }}">
<input type="hidden" name="patient_id" value="{{ $visit->patient_id }}">
<input type="hidden" name="doctor_id" value="{{ $visit->doctor_id }}">

<div class="row">

<!-- ================= LEFT PANEL ================= -->
<div class="col-md-8">

<!-- PATIENT + DOCTOR CARD -->
<div class="card card-outline card-primary">
<div class="card-header">
<h3 class="card-title">Patient Overview</h3>
</div>

<div class="card-body">
<div class="row">

<div class="col-md-6">
<div class="info-box shadow-sm">
<span class="info-box-icon bg-primary">
<i class="fas fa-user"></i>
</span>
<div class="info-box-content">
<span class="info-box-text">Patient</span>
<span class="info-box-number">
{{ $visit->patient->patient_name }}
</span>
<small>UHID: {{ $visit->patient->uhid ?? '-' }}</small>
</div>
</div>
</div>

<div class="col-md-6">
<div class="info-box shadow-sm">
<span class="info-box-icon bg-warning">
<i class="fas fa-user-md"></i>
</span>
<div class="info-box-content">
<span class="info-box-text">Doctor</span>
<span class="info-box-number">
{{ $visit->doctor->doctor_name }}
</span>
<small>OPD Consultant</small>
</div>
</div>
</div>

</div>
</div>
</div>

<!-- ADMISSION DETAILS -->
<div class="card card-outline card-success mt-3">
<div class="card-header">
<h3 class="card-title">Admission Details</h3>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">
<label>Source</label>
<select name="source" class="form-control" required>
<option>OPD</option>
<option>Emergency</option>
<option>Direct</option>
<option>Referral</option>
</select>
</div>

<div class="col-md-4">
<label>Admission Date</label>
<input type="date" name="admission_date"
value="{{ date('Y-m-d') }}"
class="form-control" required>
</div>

<div class="col-md-4">
<label>Admission Time</label>
<input type="time" name="admission_time"
value="{{ date('H:i') }}"
class="form-control" required>
</div>

</div>

<div class="mt-3">
<label>Reason for Admission</label>
<textarea name="reason" class="form-control" rows="3"
placeholder="Enter clinical reason..."></textarea>
</div>

<div class="mt-3">
<label>Remarks</label>
<textarea name="remarks" class="form-control" rows="2"
placeholder="Additional notes..."></textarea>
</div>

</div>
</div>

</div>

<!-- ================= RIGHT PANEL ================= -->
<div class="col-md-4">

<!-- BED SELECTION CARD -->
<div class="card card-outline card-danger sticky-top" style="top:10px;">
<div class="card-header">
<h3 class="card-title">Bed Allocation</h3>
</div>

<div class="card-body">

<label>Select Available Bed</label>

<select name="bed_id" class="form-control form-control-lg" required>
<option value="">-- Choose Bed --</option>

@foreach($beds as $bed)
<option value="{{ $bed->id }}">
{{ $bed->ward->ward_name }} |
Room {{ $bed->room_no }} |
Bed {{ $bed->bed_no }}
</option>
@endforeach
</select>

<hr>

<div class="alert alert-info p-2">
<small>
<i class="fas fa-info-circle"></i>
Only available beds are shown
</small>
</div>

</div>

<div class="card-footer">
<button type="submit" class="btn btn-success btn-block btn-lg">
<i class="fas fa-procedures"></i> Admit Patient
</button>
</div>
</div>

</div>

</div>

</form>

</div>

@stop