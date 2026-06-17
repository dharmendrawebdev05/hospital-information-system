@extends('adminlte::page')

@section('title', 'Pharmacy Queue')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">

<h3 class="card-title">
Pharmacy Queue
</h3>

</div>

<div class="card-body">

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Visit No</th>

<th>Patient</th>

<th>Doctor</th>

<th>Date</th>

<th>Status</th>

<th width="150">Action</th>

</tr>

</thead>

<tbody>

@forelse($visits as $visit)

<tr>

<td>
{{ $visit->visit_no }}
</td>

<td>
{{ $visit->patient->patient_name ?? '' }}
</td>

<td>
{{ $visit->doctor->doctor_name ?? '' }}
</td>

<td>
{{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}
</td>

<td>

<span class="badge badge-success">

{{ $visit->status }}

</span>

</td>

<td>

<a href="{{ route('pharmacy.create.from.opd',$visit->id) }}"
class="btn btn-primary btn-sm">

Generate Bill

</a>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center">

No Completed OPD Visits Found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

@stop