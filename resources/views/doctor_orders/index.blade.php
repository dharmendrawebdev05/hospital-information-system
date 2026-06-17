@extends('adminlte::page')

@section('title', 'Doctor Orders')

@section('content_header')

<div class="d-flex justify-content-between">

<h1>Doctor Orders</h1>

<a href="{{ route('ipd.orders.create', $admission->id) }}"
class="btn btn-primary">

<i class="fas fa-plus"></i> Add Order

</a>

</div>

@stop

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">

<h3 class="card-title">
Patient: {{ $admission->patient->patient_name ?? '-' }}
</h3>

</div>

<div class="card-body">

@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif

<div class="table-responsive">

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>#</th>
<th>Date</th>
<th>Type</th>
<th>Order</th>
<th>Instructions</th>
<th>Doctor</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

@forelse($orders as $order)

<tr>

<td>{{ $loop->iteration }}</td>

<td>
{{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y H:i') }}
</td>

<td>

@if($order->order_type == 'lab')
<span class="badge badge-info">Lab</span>

@elseif($order->order_type == 'radiology')
<span class="badge badge-primary">Radiology</span>

@elseif($order->order_type == 'medicine')
<span class="badge badge-success">Medicine</span>

@elseif($order->order_type == 'procedure')
<span class="badge badge-warning">Procedure</span>

@else
<span class="badge badge-secondary">Diet</span>
@endif

</td>

<td>
{{ $order->order_name }}
</td>

<td>
{{ $order->instructions }}
</td>

<td>
{{ $order->doctor->doctor_name ?? '-' }}
</td>

<td>

@if($order->status == 'pending')

<span class="badge badge-warning">Pending</span>

@elseif($order->status == 'in_progress')

<span class="badge badge-info">In Progress</span>

@elseif($order->status == 'completed')

<span class="badge badge-success">Completed</span>

@elseif($order->status == 'cancelled')

<span class="badge badge-danger">Cancelled</span>

@endif

</td>

<td>

{{-- STATUS FLOW BUTTONS --}}
@if($order->status == 'pending')

<form action="{{ route('ipd.orders.status', $order->id) }}"
method="POST"
style="display:inline-block;">

@csrf

<input type="hidden" name="status" value="in_progress">

<button class="btn btn-info btn-sm">
Start
</button>

</form>

@elseif($order->status == 'in_progress')

<form action="{{ route('ipd.orders.status', $order->id) }}"
method="POST"
style="display:inline-block;">

@csrf

<input type="hidden" name="status" value="completed">

<button class="btn btn-success btn-sm">
Complete
</button>

</form>

@else

<span class="badge badge-success">Done</span>

@endif


@php
$alreadyActivated = \App\Models\IpdMedicationOrder::where('doctor_order_id', $order->id)->exists();
@endphp

@if($order->order_type == 'medicine' && !$alreadyActivated)

<form action="{{ route('ipd.medications.activate', $order->id) }}"
      method="POST"
      style="display:inline-block;">

    @csrf

    <button class="btn btn-primary btn-sm">
        Activate
    </button>

</form>

@elseif($order->order_type == 'medicine' && $alreadyActivated)

<span class="badge badge-success">
    Activated
</span>


<a href="{{ route('ipd.medications.index', $admission->id) }}"
   class="btn btn-danger">
    <i class="fas fa-pills"></i> Medications
</a>




@endif

</td>

</tr>

@empty

<tr>
<td colspan="8" class="text-center">
No Orders Found
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

@stop