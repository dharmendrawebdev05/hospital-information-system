@extends('adminlte::page')

@section('title','Edit Doctor Schedule')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h3>Edit Schedule</h3>
</div>

<form method="POST"
action="{{ route('doctor-schedules.update',$doctor_schedule->id) }}">

@csrf
@method('PUT')

<div class="card-body">

<div class="row">

<div class="col-md-4">

<label>Doctor</label>

<select name="doctor_id"
class="form-control">

@foreach($doctors as $doctor)

<option value="{{ $doctor->id }}"
{{ $doctor_schedule->doctor_id == $doctor->id ? 'selected' : '' }}>

{{ $doctor->doctor_name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-4">

<label>Day</label>

<select name="day_name"
class="form-control">

@php
$days = [
'Monday',
'Tuesday',
'Wednesday',
'Thursday',
'Friday',
'Saturday',
'Sunday'
];
@endphp

@foreach($days as $day)

<option value="{{ $day }}"
{{ $doctor_schedule->day_name == $day ? 'selected' : '' }}>

{{ $day }}

</option>

@endforeach

</select>

</div>

<div class="col-md-4">

<label>Max Patient</label>

<input type="number"
name="max_patient"
value="{{ $doctor_schedule->max_patient }}"
class="form-control">

</div>

<div class="col-md-4 mt-3">

<label>Start Time</label>

<input type="time"
name="start_time"
value="{{ $doctor_schedule->start_time }}"
class="form-control">

</div>

<div class="col-md-4 mt-3">

<label>End Time</label>

<input type="time"
name="end_time"
value="{{ $doctor_schedule->end_time }}"
class="form-control">

</div>


<div class="col-md-4 mt-3">

<label>Slot Duration (Minutes)</label>

<input type="number"
name="slot_duration"
class="form-control"
value="{{ $doctor_schedule->slot_duration }}"
min="5"
max="120"
required>

</div>




<div class="col-md-4 mt-3">

<label>Status</label>

<select name="status"
class="form-control">

<option value="1"
{{ $doctor_schedule->status == 1 ? 'selected' : '' }}>

Active

</option>

<option value="0"
{{ $doctor_schedule->status == 0 ? 'selected' : '' }}>

Inactive

</option>

</select>

</div>

</div>

</div>

<div class="card-footer">

<button type="submit"
class="btn btn-success">

Update Schedule

</button>

<a href="{{ route('doctor-schedules.index') }}"
class="btn btn-secondary">

Back

</a>

</div>

</form>

</div>

@stop