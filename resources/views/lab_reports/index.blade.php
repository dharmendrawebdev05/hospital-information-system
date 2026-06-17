@extends('adminlte::page')

@section('title','Lab Reports')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
    <h3>Completed Lab Reports</h3>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
    <th>ID</th>
    <th>Patient</th>
    <th>Test</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@foreach($reports as $r)
<tr>

    <td>{{ $r->id }}</td>
    <td>{{ $r->patient->patient_name }}</td>
    <td>{{ $r->test->test_name }}</td>

    <td>
        <a href="{{ url('/lab-reports/'.$r->id) }}"
           class="btn btn-primary btn-sm">
            View Report
        </a>
    </td>

</tr>
@endforeach

</tbody>

</table>

</div>

</div>

@stop