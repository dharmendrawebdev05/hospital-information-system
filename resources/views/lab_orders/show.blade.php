@extends('adminlte::page')

@section('title','Lab Order Details')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
    <h3>Lab Order Details</h3>
</div>

<div class="card-body">

<!-- PATIENT INFO -->
<p><strong>Patient:</strong> {{ $order->patient->patient_name }}</p>
<p><strong>Doctor:</strong> {{ $order->doctor->doctor_name }}</p>
<p><strong>Test:</strong> {{ $order->test->test_name }}</p>
<p><strong>Status:</strong>

@if($order->status == 'Pending')
    <span class="badge badge-warning">Pending</span>
@elseif($order->status == 'Processing')
    <span class="badge badge-info">Processing</span>
@else
    <span class="badge badge-success">Completed</span>
@endif

</p>

@if($order->instruction)
<p><strong>Instruction:</strong> {{ $order->instruction }}</p>
@endif

<hr>

<!-- CONSULTATION LINK -->
@if($order->consultation)
<p>
    <strong>From Consultation ID:</strong>
    {{ $order->consultation->id }}
</p>
@endif

<hr>

<!-- ACTION BUTTONS -->
@if($order->status == 'Pending')

<form method="POST" action="/lab-orders/processing/{{ $order->id }}">
@csrf
<button class="btn btn-info">Start Processing</button>
</form>

@elseif($order->status == 'Processing')

<a href="{{ url('/lab-results/create/'.$order->id) }}"
   class="btn btn-warning">
    Enter Lab Result
</a>

@else

<span class="text-success font-weight-bold">
    Report Completed
</span>

@endif

</div>

</div>

@stop