@extends('adminlte::page')

@section('title','Edit Session')

@section('content')

<div class="card card-outline card-primary mt-3">

<div class="card-header">
<h3>Edit Session</h3>
</div>

<form method="POST"
action="{{ route(
'doctor-schedules.sessions.update',
[
$doctorSchedule->id,
$session->id
]
) }}">

@csrf
@method('PUT')

<div class="card-body">

<div class="row">

<div class="col-md-6">

<label>
Session Name
</label>

<input type="text"
name="session_name"
class="form-control"
value="{{ old(
'session_name',
$session->session_name
) }}"
required>

</div>

<div class="col-md-3">

<label>
Start Time
</label>

<input type="time"
name="start_time"
value="{{ $session->start_time }}"
class="form-control"
required>

</div>

<div class="col-md-3">

<label>
End Time
</label>

<input type="time"
name="end_time"
value="{{ $session->end_time }}"
class="form-control"
required>

</div>

<div class="col-md-3 mt-3">

<label>
Slot Duration
</label>

<input type="number"
name="slot_duration"
class="form-control"
value="{{ $session->slot_duration }}"
required>

</div>

<div class="col-md-3 mt-3">

<label>
Max Patients
</label>

<input type="number"
name="max_patients"
class="form-control"
value="{{ $session->max_patients }}"
required>

</div>

<div class="col-md-3 mt-5">

<div
class="custom-control
custom-switch">

<input type="checkbox"
name="is_active"
id="active"
class="custom-control-input"

{{ $session->is_active
? 'checked'
: '' }}>

<label
class="custom-control-label"
for="active">

Active

</label>

</div>

</div>

</div>

</div>

<div class="card-footer">

<button class="btn btn-primary">

Update

</button>

<a href="{{ route(
'doctor-schedules.sessions.index',
$doctorSchedule->id
) }}"
class="btn btn-secondary">

Back

</a>

</div>

</form>

</div>

@stop