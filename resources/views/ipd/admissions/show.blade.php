@extends('adminlte::page')

@section('title', 'Admission Details')

@section('content')

<div class="container-fluid mt-3">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">
Admission #{{ $admission->admission_no }}
</h4>
<small class="text-muted">IPD Patient Clinical Overview</small>
</div>

<div class="btn-group">

<a href="{{ route('ipd.admissions.index') }}" class="btn btn-secondary btn-sm">
← Back
</a>

<a href="{{ route('ipd.admissions.print', $admission->id) }}"
target="_blank"
class="btn btn-success btn-sm">
<i class="fas fa-print"></i>
</a>

</div>
</div>

<div class="row">

<!-- LEFT: PATIENT SUMMARY -->
<div class="col-md-4">

<div class="card card-outline card-primary">

<div class="card-header">
<h3 class="card-title">Patient Summary</h3>
</div>

<div class="card-body">

<h5>{{ $admission->patient->patient_name ?? '-' }}</h5>
<hr>

<p><strong>Doctor:</strong> {{ $admission->doctor->doctor_name ?? '-' }}</p>
<p><strong>Ward:</strong> {{ $admission->bed->ward->ward_name ?? '-' }}</p>
<p><strong>Bed:</strong> {{ $admission->bed->bed_no ?? '-' }}</p>

<p><strong>Admission Date:</strong><br>
{{ \Carbon\Carbon::parse($admission->admission_date)->format('d M Y') }}
</p>

<!-- STATUS -->
<p>
<strong>Status:</strong><br>

@if($admission->status == 'Admitted')
<span class="badge badge-success p-2">Admitted</span>

@elseif($admission->status == 'Discharged')
<span class="badge badge-secondary p-2">Discharged</span>

@else
<span class="badge badge-warning p-2">
{{ $admission->status }}
</span>
@endif
</p>

</div>

</div>

</div>

<!-- RIGHT: CLINICAL INFO -->
<div class="col-md-8">

<div class="card card-outline card-success">

<div class="card-header">
<h3 class="card-title">Clinical Details</h3>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">
<h6>Reason for Admission</h6>
<p class="text-muted">
{{ $admission->reason ?? '-' }}
</p>
</div>

<div class="col-md-6">
<h6>Remarks</h6>
<p class="text-muted">
{{ $admission->remarks ?? '-' }}
</p>
</div>

</div>

</div>

</div>

<!-- QUICK ACTIONS -->
<div class="card card-outline card-info mt-3">

<div class="card-header">
<h3 class="card-title">Clinical Actions</h3>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-4 mb-2">
<a href="{{ route('ipd.vitals.index',$admission->id) }}"
class="btn btn-outline-danger btn-block">
<i class="fas fa-heartbeat"></i><br>
Vitals
</a>
</div>

<div class="col-md-4 mb-2">
<a href="{{ route('ipd.rounds.index',$admission->id) }}"
class="btn btn-outline-success btn-block">
<i class="fas fa-user-md"></i><br>
Doctor Rounds
</a>
</div>

<div class="col-md-4 mb-2">
<a href="{{ route('ipd.orders.index',$admission->id) }}"
class="btn btn-outline-warning btn-block">
<i class="fas fa-pills"></i><br>
Orders
</a>
</div>

</div>

</div>

</div>

</div>

</div>

</div>

@stop