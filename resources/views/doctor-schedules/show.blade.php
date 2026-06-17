@extends('adminlte::page')

@section('title','Doctor Schedule Details')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h3>Schedule Details</h3>
</div>

<div class="card-body">

<table class="table table-bordered">

<tr>
<th>Doctor</th>
<td>{{ $doctor_schedule->doctor->doctor_name }}</td>
</tr>

<tr>
<th>Day</th>
<td>{{ $doctor_schedule->day_name }}</td>
</tr>

<tr>
<th>Start Time</th>
<td>{{ $doctor_schedule->start_time }}</td>
</tr>

<tr>
<th>End Time</th>
<td>{{ $doctor_schedule->end_time }}</td>
</tr>

<tr>
<th>Max Patient</th>
<td>{{ $doctor_schedule->max_patient }}</td>
</tr>

<tr>
<th>Status</th>
<td>
@if($doctor_schedule->status)
Active
@else
Inactive
@endif
</td>
</tr>

</table>

</div>

</div>

@stop