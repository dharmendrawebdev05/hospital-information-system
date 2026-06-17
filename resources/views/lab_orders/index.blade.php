@extends('adminlte::page')

@section('title','Lab Orders')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h3>All Lab Orders</h3>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
<th>ID</th>
<th>Patient</th>
<th>Doctor</th>
<th>Test</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@foreach($orders as $o)
<tr>

<td>{{ $o->id }}</td>

<td>{{ $o->patient->patient_name ?? '-' }}</td>

<td>{{ $o->doctor->doctor_name ?? '-' }}</td>

<td>{{ $o->test->test_name ?? '-' }}</td>

<td>{{ $o->created_at->format('d M Y') }}</td>


<td>
@if($o->status == 'Pending')
<span class="badge badge-warning">Pending</span>
@elseif($o->status == 'Processing')
<span class="badge badge-info">Processing</span>
@else
<span class="badge badge-success">Completed</span>
@endif
</td>


<td>

@if($o->status == 'Pending')

<form method="POST" action="/lab-orders/processing/{{ $o->id }}">
@csrf
<button class="btn btn-sm btn-info">Start</button>
</form>

@elseif($o->status == 'Processing')

<a href="{{ url('/lab-results/create/'.$o->id) }}"
   class="btn btn-sm btn-warning">
    Enter Result
</a>

@else

<span class="text-success font-weight-bold">
    Completed
</span>

<a href="{{ url('/lab-orders/'.$o->id) }}"
   class="btn btn-sm btn-primary">
    View
</a>



@endif

</td>




</tr>
@endforeach

</tbody>

</table>

</div>

</div>

@stop