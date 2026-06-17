@extends('adminlte::page')

@section('title', 'Add Vitals')

@section('content_header')
<h1>Record Patient Vitals</h1>
@stop

@section('content')

<div class="card mt-3  card-outline card-primary">
<div class="card-header">
<h3 class="card-title">
Patient: {{ $admission->patient->patient_name ?? '' }}
</h3>
</div>

<form action="{{ route('ipd.vitals.store', $admission->id) }}"
method="POST">

@csrf

<div class="card-body">

@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="row">

<div class="col-md-4">
<label>Date & Time</label>
<input type="datetime-local"
name="recorded_at"
class="form-control"
value="{{ now()->format('Y-m-d\TH:i') }}"
required>
</div>

<div class="col-md-4">
<label>Temperature (°F)</label>
<input type="number"
step="0.1"
name="temperature"
class="form-control">
</div>

<div class="col-md-4">
<label>Pulse (bpm)</label>
<input type="number"
name="pulse"
class="form-control">
</div>

</div>

<br>

<div class="row">

<div class="col-md-4">
<label>Respiratory Rate</label>
<input type="number"
name="respiratory_rate"
class="form-control">
</div>

<div class="col-md-4">
<label>BP Systolic</label>
<input type="number"
name="bp_systolic"
class="form-control">
</div>

<div class="col-md-4">
<label>BP Diastolic</label>
<input type="number"
name="bp_diastolic"
class="form-control">
</div>

</div>

<br>

<div class="row">

<div class="col-md-4">
<label>SpO2 (%)</label>
<input type="number"
name="spo2"
class="form-control">
</div>

<div class="col-md-4">
<label>Blood Sugar</label>
<input type="number"
step="0.01"
name="blood_sugar"
class="form-control">
</div>

<div class="col-md-4">
<label>Weight (kg)</label>
<input type="number"
step="0.01"
name="weight"
class="form-control">
</div>

</div>

<br>

<div class="form-group">
<label>Remarks</label>

<textarea name="remarks"
rows="4"
class="form-control"></textarea>
</div>

</div>

<div class="card-footer">

<button type="submit" class="btn btn-primary">
Save Vitals
</button>

<a href="{{ route('ipd.vitals.index', $admission->id) }}"
class="btn btn-secondary">
Back
</a>

</div>

</form>

</div>

@stop