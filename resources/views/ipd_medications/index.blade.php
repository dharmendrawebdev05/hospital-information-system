@extends('adminlte::page')

@section('title','IPD Medications')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
    <h3>Medication Orders</h3>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
<th>Medicine</th>
<th>Dose</th>
<th>Freq</th>
<th>Duration</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@foreach($medications as $med)

<tr>

<td>{{ $med->medicine->medicine_name }}</td>
<td>{{ $med->dose }}</td>
<td>{{ $med->frequency }}</td>
<td>{{ $med->duration }} Days</td>

<td>
<span class="badge badge-success">
{{ $med->status }}
</span>
</td>

<td>

<form method="POST"
action="{{ route('ipd.medication.give',$med->id) }}">

@csrf

<button class="btn btn-primary btn-sm">
Give Dose
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@stop