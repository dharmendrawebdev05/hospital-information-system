@extends('adminlte::page')

@section('title', 'Pharmacy Bill Details')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">

<h3 class="card-title">
Pharmacy Bill Details
</h3>

<div class="float-right">

<a href="{{ route('pharmacy.print',$bill->id) }}"
target="_blank"
class="btn btn-primary btn-sm">

<i class="fas fa-print"></i>
Print

</a>

@if($bill->status != 'Paid')

<a href="{{ route('pharmacy.payment',$bill->id) }}"
class="btn btn-success btn-sm">

<i class="fas fa-money-bill"></i>
Receive Payment

</a>

@endif

</div>

</div>

<div class="card-body">

{{-- Bill Information --}}

<div class="row mb-4">

<div class="col-md-3">

<strong>Bill No</strong>

<p>{{ $bill->bill_no }}</p>

</div>

<div class="col-md-3">

<strong>Bill Date</strong>

<p>
{{ \Carbon\Carbon::parse($bill->bill_date)->format('d M Y') }}
</p>

</div>

<div class="col-md-3">

<strong>Status</strong>

<p>

@if($bill->status == 'Paid')

<span class="badge badge-success">
Paid
</span>

@else

<span class="badge badge-warning">
Pending
</span>

@endif

</p>

</div>

<div class="col-md-3">

<strong>Total Amount</strong>

<p>
₹ {{ number_format($bill->total_amount,2) }}
</p>

</div>

</div>

{{-- Patient Info --}}

<div class="row mb-4">

<div class="col-md-4">

<strong>Patient Name</strong>

<p>
{{ $bill->patient->patient_name ?? '' }}
</p>

</div>

<div class="col-md-4">

<strong>Visit No</strong>

<p>
{{ $bill->opdVisit->visit_no ?? '' }}
</p>

</div>

<div class="col-md-4">

<strong>Paid Amount</strong>

<p>
₹ {{ number_format($bill->paid_amount,2) }}
</p>

</div>

</div>

{{-- Medicines --}}

<table class="table table-bordered">

<thead>

<tr>

<th>#</th>

<th>Medicine</th>

<th>Qty</th>

<th>Rate</th>

<th>Amount</th>

</tr>

</thead>

<tbody>

@foreach($bill->items as $item)

<tr>

<td>
{{ $loop->iteration }}
</td>

<td>
{{ $item->medicine->medicine_name ?? '' }}
</td>

<td>
{{ $item->qty }}
</td>

<td>
₹ {{ number_format($item->rate,2) }}
</td>

<td>
₹ {{ number_format($item->amount,2) }}
</td>

</tr>

@endforeach

</tbody>

<tfoot>

<tr>

<th colspan="4"
class="text-right">

Grand Total

</th>

<th>

₹ {{ number_format($bill->total_amount,2) }}

</th>

</tr>

</tfoot>

</table>

</div>

<div class="card-footer">

<a href="{{ route('pharmacy-bills.index') }}"
class="btn btn-secondary">

Back

</a>


</div>

</div>

@stop