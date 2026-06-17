@extends('adminlte::page')

@section('title','Edit Bed')

@section('content')

<div class="container-fluid mt-3">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">Edit Bed</h4>
<small class="text-muted">Update bed configuration and status</small>
</div>

<a href="{{ route('beds.index') }}" class="btn btn-outline-secondary btn-sm">
← Back
</a>
</div>

<form method="POST" action="{{ route('beds.update',$bed) }}">
@csrf
@method('PUT')

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

@foreach($wards as $ward)
<option value="{{ $ward->id }}"
{{ $bed->ward_id == $ward->id ? 'selected' : '' }}>
{{ $ward->ward_name }} ({{ $ward->ward_type }})
</option>
@endforeach

</select>
</div>

<!-- Bed + Room -->
<div class="row">

<div class="col-md-6">
<label>Bed No *</label>
<input type="text"
name="bed_no"
value="{{ $bed->bed_no }}"
class="form-control form-control-lg"
required>
</div>

<div class="col-md-6">
<label>Room No</label>
<input type="text"
name="room_no"
value="{{ $bed->room_no }}"
class="form-control form-control-lg">
</div>

</div>

<!-- Remarks -->
<div class="mt-3">
<label>Remarks</label>
<textarea name="remarks"
class="form-control"
rows="3">{{ $bed->remarks }}</textarea>
</div>

</div>
</div>

</div>

<!-- RIGHT PANEL -->
<div class="col-md-4">

<!-- STATUS CARD -->
<div class="card card-outline card-success sticky-top" style="top:10px;">

<div class="card-header">
<h3 class="card-title">Bed Status</h3>
</div>

<div class="card-body">

<!-- CURRENT STATUS DISPLAY -->
<div class="text-center mb-3">

@if($bed->status == 'Available')
<i class="fas fa-bed fa-3x text-success"></i>
<h5 class="text-success mt-2">Available</h5>

@elseif($bed->status == 'Occupied')
<i class="fas fa-procedures fa-3x text-danger"></i>
<h5 class="text-danger mt-2">Occupied</h5>

@else
<i class="fas fa-tools fa-3x text-warning"></i>
<h5 class="text-warning mt-2">{{ $bed->status }}</h5>
@endif

</div>

<hr>

<!-- STATUS CHANGE -->
<div class="form-group">
<label>Update Status</label>

<select name="status" class="form-control">
<option value="Available"
{{ $bed->status=='Available'?'selected':'' }}>
Available
</option>

<option value="Occupied"
{{ $bed->status=='Occupied'?'selected':'' }}>
Occupied
</option>

<option value="Maintenance"
{{ $bed->status=='Maintenance'?'selected':'' }}>
Maintenance
</option>

<option value="Blocked"
{{ $bed->status=='Blocked'?'selected':'' }}>
Blocked
</option>
</select>

<small class="text-muted d-block mt-2">
Changing status may affect IPD admissions
</small>
</div>

</div>

<div class="card-footer">
<button class="btn btn-success btn-block btn-lg">
<i class="fas fa-save"></i> Update Bed
</button>
</div>

</div>

</div>

</div>

</form>

</div>

@stop