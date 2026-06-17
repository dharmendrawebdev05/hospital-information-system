@extends('adminlte::page')

@section('title','Doctor Round')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h3>Add Doctor Round</h3>
</div>

<form action="{{ route('ipd.rounds.store',$admission->id) }}"
method="POST">

@csrf

<div class="card-body">

<div class="form-group">
<label>Doctor</label>

<select name="doctor_id"
class="form-control"
required>

<option value="">
Select Doctor
</option>

@foreach($doctors as $doctor)

<option value="{{ $doctor->id }}">
{{ $doctor->doctor_name }}
</option>

@endforeach

</select>
</div>

<div class="form-group">
<label>Round Time</label>

<input type="datetime-local"
name="round_time"
class="form-control"
value="{{ now()->format('Y-m-d\TH:i') }}"
required>
</div>

<div class="form-group">
<label>Chief Complaint</label>

<textarea name="chief_complaint"
class="form-control"
rows="3"></textarea>
</div>

<div class="form-group">
<label>Clinical Notes</label>

<textarea name="clinical_notes"
class="form-control"
rows="5"></textarea>
</div>

<div class="form-group">
<label>Diagnosis</label>

<textarea name="diagnosis"
class="form-control"
rows="4"></textarea>
</div>

<div class="form-group">
<label>Treatment Plan</label>

<textarea name="treatment_plan"
class="form-control"
rows="4"></textarea>
</div>

<div class="form-group">
<label>Doctor Orders</label>

<textarea name="doctor_orders"
class="form-control"
rows="4"></textarea>
</div>

</div>

<div class="card-footer">

<button class="btn btn-primary">
Save Round
</button>

</div>

</form>

</div>

@stop