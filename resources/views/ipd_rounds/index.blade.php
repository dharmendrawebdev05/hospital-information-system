@extends('adminlte::page')

@section('title','Doctor Rounds')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">

<h3 class="card-title">
{{ $admission->patient->patient_name }}
</h3>

<div class="float-right">

<a href="{{ route('ipd.rounds.create',$admission->id) }}"
class="btn btn-primary">

Add Round

</a>

</div>

</div>

<div class="card-body">

@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif

<table class="table table-bordered">

<thead>

<tr>
<th>Date Time</th>
<th>Doctor</th>
<th>Diagnosis</th>
<th>Treatment</th>
</tr>

</thead>

<tbody>

@forelse($rounds as $round)

<tr>

<td>
{{ $round->round_time }}
</td>

<td>
{{ $round->doctor->doctor_name }}
</td>

<td>
{{ Str::limit($round->diagnosis,80) }}
</td>

<td>
{{ Str::limit($round->treatment_plan,80) }}
</td>

</tr>

@empty

<tr>
<td colspan="4"
class="text-center">

No Rounds Found

</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

@stop