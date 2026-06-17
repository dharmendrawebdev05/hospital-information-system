@extends('adminlte::page')

@section('title','Doctor Schedule')

@section('content')


@section('content_header')
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">Create Doctor Schedule</h4>
<small class="text-muted">Configure Doctor Schedule for OPD Appointment</small>
</div>

<a href="{{ route('doctor-schedules.index') }}" class="btn btn-outline-secondary btn-sm">
← Back
</a>
</div>
@stop

<div class="card mt-3  card-outline card-primary">

<form method="POST"
action="{{ route('doctor-schedules.store') }}">

@csrf

<div class="card-body">



@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif


@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

{{ session('success') }}

<button type="button"
class="close"
data-dismiss="alert">

<span>&times;</span>

</button>

</div>

@endif

<div class="row">

<div class="col-md-4">
<label>Doctor</label>

<select name="doctor_id"
class="form-control">

@foreach($doctors as $doctor)

<option value="{{ $doctor->id }}">
{{ $doctor->doctor_name }}
</option>

@endforeach

</select>
</div>

<div class="col-md-4">
<label>Day</label>

<select name="day_name"
class="form-control">

<option>Monday</option>
<option>Tuesday</option>
<option>Wednesday</option>
<option>Thursday</option>
<option>Friday</option>
<option>Saturday</option>
<option>Sunday</option>

</select>

</div>

</div>

</div>

<div class="card-footer">

<button class="btn btn-success">
Save Schedule
</button>

</div>

</form>

</div>

@stop