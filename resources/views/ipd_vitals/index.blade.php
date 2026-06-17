@extends('adminlte::page')

@section('title', 'IPD Vitals')

@section('content_header')

<div class="d-flex justify-content-between">
<h1>Patient Vitals</h1>

<a href="{{ route('ipd.vitals.create', $admission->id) }}"
class="btn btn-primary">
Add Vitals
</a>
</div>

@stop

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h3 class="card-title">
{{ $admission->patient->patient_name ?? '' }}
</h3>
</div>

<div class="card-body">

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>Date Time</th>
<th>Temp</th>
<th>Pulse</th>
<th>RR</th>
<th>BP</th>
<th>SpO2</th>
<th>Sugar</th>
<th>Weight</th>
<th>Remarks</th>
</tr>
</thead>

<tbody>

@forelse($vitals as $vital)

<tr>

<td>
{{ $vital->recorded_at }}
</td>

<td>
{{ $vital->temperature }}
</td>

<td>
{{ $vital->pulse }}
</td>

<td>
{{ $vital->respiratory_rate }}
</td>

<td>
{{ $vital->bp_systolic }}/{{ $vital->bp_diastolic }}
</td>

<td>
{{ $vital->spo2 }}
</td>

<td>
{{ $vital->blood_sugar }}
</td>

<td>
{{ $vital->weight }}
</td>

<td>
{{ $vital->remarks }}
</td>

</tr>

@empty

<tr>
<td colspan="9" class="text-center">
No Vitals Recorded
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

@stop