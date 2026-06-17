@extends('adminlte::page')

@section('title','Pending Lab Orders')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
    <h3>Pending Orders</h3>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
    <th>Patient</th>
    <th>Test</th>
    <th>Instruction</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@foreach($orders as $o)
<tr>

    <td>{{ $o->patient->patient_name }}</td>

    <td>{{ $o->test->test_name }}</td>

    <td>{{ $o->instruction ?? '-' }}</td>

    <td>
        <form method="POST" action="/lab-orders/processing/{{ $o->id }}">
            @csrf
            <button class="btn btn-info btn-sm">Start Processing</button>
        </form>
    </td>

</tr>
@endforeach

</tbody>

</table>

</div>

</div>

@stop