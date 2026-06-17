@extends('adminlte::page')

@section('title','Session Details')

@section('content')

<div class="card card-outline card-primary mt-3">

<div class="card-header">

<h3>

Session Details

</h3>

</div>

<div class="card-body">

<table
class="table table-bordered">

<tr>
<th>Doctor</th>
<td>
{{ $doctorSchedule
->doctor
->doctor_name }}
</td>
</tr>

<tr>
<th>Day</th>
<td>
{{ $doctorSchedule
->day_of_week }}
</td>
</tr>

<tr>
<th>Session</th>
<td>
{{ $session
->session_name }}
</td>
</tr>

<tr>
<th>Start Time</th>
<td>
{{ date(
'h:i A',
strtotime(
$session->start_time
)
) }}
</td>
</tr>

<tr>
<th>End Time</th>
<td>
{{ date(
'h:i A',
strtotime(
$session->end_time
)
) }}
</td>
</tr>

<tr>
<th>Slot Duration</th>
<td>
{{ $session
->slot_duration }}
Minutes
</td>
</tr>

<tr>
<th>Max Patients</th>
<td>
{{ $session
->max_patients }}
</td>
</tr>

<tr>
<th>Status</th>
<td>

@if(
$session->is_active
)

<span
class="badge
badge-success">

Active

</span>

@else

<span
class="badge
badge-danger">

Inactive

</span>

@endif

</td>
</tr>

</table>

</div>

</div>

@stop