@extends('adminlte::page')

@section('title','Create Ward')

@section('content')

<div class="container-fluid mt-3">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">Create Ward</h4>
<small class="text-muted">Add new hospital ward configuration</small>
</div>

<a href="{{ route('wards.index') }}" class="btn btn-outline-secondary btn-sm">
← Back
</a>
</div>

<form method="POST" action="{{ route('wards.store') }}">
@csrf

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
<input type="text" name="ward_name"
class="form-control form-control-lg"
placeholder="e.g. General Ward A"
required>
</div>

<!-- Ward Type -->
<div class="form-group">
<label>Ward Type *</label>
<select name="ward_type" class="form-control" required>
<option value="">-- Select Type --</option>
<option>General</option>
<option>Semi Private</option>
<option>Private</option>
<option>ICU</option>
<option>NICU</option>
<option>PICU</option>
</select>
</div>

<!-- Floor -->
<div class="form-group">
<label>Floor Number</label>
<input type="number" name="floor_no"
value="1"
class="form-control">
</div>

<!-- Capacity (NEW - IMPORTANT) -->
<div class="form-group">
<label>Total Bed Capacity</label>
<input type="number" name="capacity"
class="form-control"
placeholder="e.g. 20 beds">
</div>

</div>
</div>

</div>

<!-- RIGHT PANEL -->
<div class="col-md-4">

<div class="card card-outline card-success sticky-top" style="top:10px;">

<div class="card-header">
<h3 class="card-title">Status</h3>
</div>

<div class="card-body">

<!-- ACTIVE -->
<div class="form-group">
<label>Ward Status</label><br>

<input type="checkbox"
name="is_active"
checked
data-bootstrap-switch
data-off-color="danger"
data-on-color="success">

<small class="text-muted d-block mt-2">
Enable ward for admissions
</small>
</div>

<hr>

<div class="alert alert-info p-2">
<small>
<i class="fas fa-info-circle"></i>
Ward will be available for bed allocation after saving.
</small>
</div>

</div>

<div class="card-footer">
<button class="btn btn-success btn-block btn-lg">
<i class="fas fa-save"></i> Save Ward
</button>
</div>

</div>

</div>

</div>

</form>

</div>

@stop