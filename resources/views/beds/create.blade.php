@extends('adminlte::page')

@section('title','Create Bed')

@section('content')

<div class="container-fluid mt-3">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">Create Bed</h4>
<small class="text-muted">Configure ward bed for IPD allocation</small>
</div>

<a href="{{ route('beds.index') }}" class="btn btn-outline-secondary btn-sm">
← Back
</a>
</div>

<form method="POST" action="{{ route('beds.store') }}">
@csrf

<div class="row">

<!-- LEFT PANEL -->
<div class="col-md-8">

<div class="card card-outline card-primary">
<div class="card-header">
<h3 class="card-title">Bed Information</h3>
</div>

<div class="card-body">

<!-- Ward -->
<div class="form-group">
<label>Ward *</label>
<select name="ward_id" class="form-control form-control-lg" required>
<option value="">-- Select Ward --</option>

@foreach($wards as $ward)
<option value="{{ $ward->id }}">
{{ $ward->ward_name }} ({{ $ward->ward_type }})
</option>
@endforeach
</select>
</div>

<!-- Bed No + Room -->
<div class="row">

<div class="col-md-6">
<label>Bed No *</label>
<input type="text"
name="bed_no"
class="form-control form-control-lg"
placeholder="e.g. B-101"
required>
</div>

<div class="col-md-6">
<label>Room No</label>
<input type="text"
name="room_no"
class="form-control form-control-lg"
placeholder="e.g. R-12">
</div>

</div>

<!-- Remarks -->
<div class="mt-3">
<label>Remarks</label>
<textarea name="remarks"
class="form-control"
rows="3"
placeholder="Optional notes..."></textarea>
</div>

</div>
</div>

</div>

<!-- RIGHT PANEL -->
<div class="col-md-4">

<div class="card card-outline card-success sticky-top" style="top:10px;">

<div class="card-header">
<h3 class="card-title">Bed Status</h3>
</div>

<div class="card-body">

<!-- STATUS -->
<div class="form-group">
<label>Status</label>

<select name="status" class="form-control">
<option value="Available">Available</option>
<option value="Maintenance">Maintenance</option>
<option value="Blocked">Blocked</option>
</select>

<small class="text-muted d-block mt-2">
Only available beds can be assigned to patients
</small>
</div>

<hr>

<div class="alert alert-info p-2">
<small>
<i class="fas fa-info-circle"></i>
Bed will be used in IPD admission system after saving.
</small>
</div>

</div>

<div class="card-footer">
<button class="btn btn-success btn-block btn-lg">
<i class="fas fa-bed"></i> Save Bed
</button>
</div>

</div>

</div>

</div>

</form>

</div>

@stop