@extends('adminlte::page')

@section('title','Edit Ward')

@section('content')

<div class="container-fluid mt-3">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">Edit Ward</h4>
<small class="text-muted">Update ward configuration for IPD system</small>
</div>

<a href="{{ route('wards.index') }}" class="btn btn-outline-secondary btn-sm">
← Back
</a>
</div>

<form method="POST" action="{{ route('wards.update',$ward) }}">
@csrf
@method('PUT')

<div class="row">

<!-- LEFT PANEL -->
<div class="col-md-8">

<div class="card card-outline card-primary">
<div class="card-header">
<h3 class="card-title">Ward Information</h3>
</div>

<div class="card-body">

<!-- Ward Name -->
<div class="form-group">
<label>Ward Name *</label>
<input type="text"
name="ward_name"
value="{{ $ward->ward_name }}"
class="form-control form-control-lg"
required>
</div>

<!-- Ward Type -->
<div class="form-group">
<label>Ward Type *</label>

<select name="ward_type" class="form-control form-control-lg" required>

@foreach([
'General',
'Semi Private',
'Private',
'ICU',
'NICU',
'PICU'
] as $type)

<option value="{{ $type }}"
{{ $ward->ward_type == $type ? 'selected' : '' }}>
{{ $type }}
</option>

@endforeach

</select>
</div>

<!-- Floor -->
<div class="form-group">
<label>Floor Number</label>
<input type="number"
name="floor_no"
value="{{ $ward->floor_no }}"
class="form-control">
</div>

</div>
</div>

</div>

<!-- RIGHT PANEL -->
<div class="col-md-4">

<!-- STATUS CARD -->
<div class="card card-outline card-success sticky-top" style="top:10px;">

<div class="card-header">
<h3 class="card-title">Ward Status</h3>
</div>

<div class="card-body text-center">

@if($ward->is_active)
<i class="fas fa-hospital fa-3x text-success"></i>
<h5 class="text-success mt-2">Active Ward</h5>
@else
<i class="fas fa-ban fa-3x text-danger"></i>
<h5 class="text-danger mt-2">Inactive Ward</h5>
@endif

<hr>

<!-- TOGGLE -->
<div class="form-group text-left">
<label>Ward Status</label><br>

<input type="checkbox"
name="is_active"
data-bootstrap-switch
data-off-color="danger"
data-on-color="success"
{{ $ward->is_active ? 'checked' : '' }}>

<small class="text-muted d-block mt-2">
Inactive wards will not appear in bed allocation
</small>
</div>

</div>

<div class="card-footer">
<button class="btn btn-success btn-block btn-lg">
<i class="fas fa-save"></i> Update Ward
</button>
</div>

</div>

</div>

</div>

</form>

</div>

@stop