@extends('adminlte::page')

@section('title','Lab Result Entry')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
    <h3>
        Result Entry - {{ $order->patient->patient_name }}
    </h3>
</div>

<div class="card-body">

<form method="POST" action="/lab-results/store/{{ $order->id }}">
@csrf

<table class="table table-bordered" id="resultTable">

<thead>
<tr>
    <th>Parameter</th>
    <th>Result</th>
    <th>Unit</th>
    <th>Normal Range</th>
    <th>Remarks</th>
</tr>
</thead>

<tbody>

<tr>
    <td><input name="parameter[]" class="form-control"></td>
    <td><input name="result[]" class="form-control"></td>
    <td><input name="unit[]" class="form-control"></td>
    <td><input name="normal_range[]" class="form-control"></td>
    <td><input name="remarks[]" class="form-control"></td>
</tr>

</tbody>

</table>

<button type="submit" class="btn btn-success">
Save Result
</button>

</form>

</div>

</div>

@stop