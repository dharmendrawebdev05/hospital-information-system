@extends('adminlte::page')

@section('title','Create Session')

@section('content')

<div class="card card-outline card-primary mt-3">

<div class="card-header">

<h3>

Create Session

<small>

{{ $doctorSchedule->doctor->doctor_name }}
-
{{ $doctorSchedule->day_name }}

</small>

</h3>

</div>

<form method="POST"
action="{{ route(
'doctor-schedules.sessions.store',
$doctorSchedule->id
) }}">

@csrf

<div class="card-body">

<div class="row">

<div class="col-md-6">

<label>
Session Name
</label>

<input type="text"
name="session_name"
class="form-control"
value="{{ old('session_name') }}"
required>

</div>

<div class="col-md-3">

<label>
Start Time
</label>

<input type="time"
name="start_time"
class="form-control"
required>

</div>

<div class="col-md-3">

<label>
End Time
</label>

<input type="time"
name="end_time"
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
value="20"
required>

</div>

<div class="col-md-3 mt-3">

<label>
Max Patients
</label>

<input type="number"
name="max_patients"
class="form-control"
value="50"
required>

</div>

<div class="col-md-3 mt-5">

<div
class="custom-control
custom-switch">

<input type="checkbox"
name="is_active"
class="custom-control-input"
id="active"
checked>

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

<button class="btn btn-success">

Save

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