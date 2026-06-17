@extends('adminlte::page')

@section('title','Ward Details')

@section('content')

<div class="container-fluid mt-3">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">{{ $ward->ward_name }}</h4>
<small class="text-muted">Ward details & bed occupancy overview</small>
</div>

<div>
<a href="{{ route('wards.index') }}" class="btn btn-outline-secondary btn-sm">
← Back
</a>
<a href="{{ route('wards.edit', $ward->id) }}" class="btn btn-primary btn-sm">
Edit Ward
</a>
</div>
</div>

<div class="row">

<!-- LEFT PANEL -->
<div class="col-md-4">

<!-- WARD SUMMARY CARD -->
<div class="card card-outline card-primary">

<div class="card-header">
<h3 class="card-title">Ward Info</h3>
</div>

<div class="card-body">

<p><strong>Type:</strong> {{ $ward->ward_type }}</p>
<p><strong>Floor:</strong> {{ $ward->floor_no }}</p>
<p><strong>Total Beds:</strong> {{ $ward->total_beds }}</p>

<hr>

@php
$total = $ward->beds->count();
$available = $ward->beds->where('status','Available')->count();
$occupied = $ward->beds->where('status','Occupied')->count();
@endphp

<!-- STATS -->
<div class="row text-center">

<div class="col-4">
<div class="small-box bg-success p-2">
<h5>{{ $available }}</h5>
<small>Available</small>
</div>
</div>

<div class="col-4">
<div class="small-box bg-danger p-2">
<h5>{{ $occupied }}</h5>
<small>Occupied</small>
</div>
</div>

<div class="col-4">
<div class="small-box bg-info p-2">
<h5>{{ $total }}</h5>
<small>Total</small>
</div>
</div>

</div>

</div>

</div>

</div>

<!-- RIGHT PANEL -->
<div class="col-md-8">

<!-- BEDS CARD -->
<div class="card card-outline card-success">

<div class="card-header d-flex justify-content-between">
<h3 class="card-title">Beds Overview</h3>
</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover table-bordered">

<thead class="thead-light">
<tr>
<th>Bed No</th>
<th>Room</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($ward->beds as $bed)

<tr>
<td><strong>{{ $bed->bed_no }}</strong></td>
<td>{{ $bed->room_no ?? '-' }}</td>
<td>

@if($bed->status == 'Available')
<span class="badge badge-success">Available</span>

@elseif($bed->status == 'Occupied')
<span class="badge badge-danger">Occupied</span>

@elseif($bed->status == 'Maintenance')
<span class="badge badge-warning">Maintenance</span>

@else
<span class="badge badge-secondary">{{ $bed->status }}</span>
@endif

</td>
</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

</div>

@stop