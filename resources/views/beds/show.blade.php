@extends('adminlte::page')

@section('title','Bed Details')

@section('content')

<div class="container-fluid mt-3">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">Bed Details</h4>
<small class="text-muted">Complete information about bed configuration</small>
</div>

<a href="{{ route('beds.index') }}" class="btn btn-outline-secondary btn-sm">
← Back
</a>
</div>

<div class="row">

<!-- LEFT PANEL -->
<div class="col-md-8">

<!-- BED INFO CARD -->
<div class="card card-outline card-primary">
<div class="card-header">
<h3 class="card-title">Bed Information</h3>
</div>

<div class="card-body">

<table class="table table-bordered">
<tr>
<th width="30%">Ward</th>
<td>{{ $bed->ward->ward_name }}</td>
</tr>

<tr>
<th>Bed No</th>
<td>{{ $bed->bed_no }}</td>
</tr>

<tr>
<th>Room No</th>
<td>{{ $bed->room_no ?? '-' }}</td>
</tr>

<tr>
<th>Status</th>
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

<tr>
<th>Remarks</th>
<td>{{ $bed->remarks ?? '-' }}</td>
</tr>
</table>

</div>
</div>

</div>

<!-- RIGHT PANEL -->
<div class="col-md-4">

<!-- STATUS CARD -->
<div class="card card-outline card-success">

<div class="card-header">
<h3 class="card-title">Status Overview</h3>
</div>

<div class="card-body text-center">

@if($bed->status == 'Available')
<div class="text-success">
<i class="fas fa-bed fa-3x"></i>
<h5 class="mt-2">Available</h5>
</div>

@elseif($bed->status == 'Occupied')
<div class="text-danger">
<i class="fas fa-procedures fa-3x"></i>
<h5 class="mt-2">Occupied</h5>
</div>

@else
<div class="text-warning">
<i class="fas fa-tools fa-3x"></i>
<h5 class="mt-2">{{ $bed->status }}</h5>
</div>
@endif

</div>

</div>

<!-- QUICK INFO CARD -->
<div class="card card-outline card-info mt-3">

<div class="card-header">
<h3 class="card-title">Quick Info</h3>
</div>

<div class="card-body">

<ul class="list-group list-group-flush">

<li class="list-group-item">
<strong>Ward Type:</strong>
{{ $bed->ward->ward_type ?? '-' }}
</li>

<li class="list-group-item">
<strong>Floor:</strong>
{{ $bed->ward->floor_no ?? '-' }}
</li>

<li class="list-group-item">
<strong>Created At:</strong>
{{ $bed->created_at->format('d M Y') }}
</li>

</ul>

</div>

</div>

</div>

</div>

</div>

@stop