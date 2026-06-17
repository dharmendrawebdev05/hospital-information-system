@extends('adminlte::page')

@section('title', 'Diet Details')

@section('content')

<div class="card mt-3 card-outline card-primary shadow">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-utensils"></i>
Diet Details
</h3>

<div class="card-tools">

<a href="{{ route('diets.index') }}"
class="btn btn-secondary btn-sm">

<i class="fas fa-arrow-left"></i>
Back

</a>

</div>

</div>

<div class="card-body">

<div class="row">

<!-- Left Section -->
<div class="col-md-4 text-center border-right">

<div class="mb-3">
<i class="fas fa-utensils fa-6x text-success"></i>
</div>

<h4 class="font-weight-bold">
{{ $diet->diet_name }}
</h4>

<span class="badge badge-info p-2">
{{ $diet->category }}
</span>

</div>

<!-- Right Section -->
<div class="col-md-8">

<table class="table table-bordered table-striped">

<tr>
<th width="30%">Diet Code</th>
<td>{{ $diet->diet_code }}</td>
</tr>

<tr>
<th>Diet Name</th>
<td>{{ $diet->diet_name }}</td>
</tr>

<tr>
<th>Category</th>
<td>
<span class="badge badge-primary">
{{ $diet->category }}
</span>
</td>
</tr>

<tr>
<th>Description</th>
<td>
{{ $diet->description ?: '-' }}
</td>
</tr>

<tr>
<th>Status</th>
<td>

@if($diet->status == 'Active')

<span class="badge badge-success">
Active
</span>

@else

<span class="badge badge-danger">
Inactive
</span>

@endif

</td>
</tr>

<tr>
<th>Created At</th>
<td>
{{ $diet->created_at->format('d-m-Y h:i A') }}
</td>
</tr>

<tr>
<th>Last Updated</th>
<td>
{{ $diet->updated_at->format('d-m-Y h:i A') }}
</td>
</tr>

</table>

</div>

</div>

</div>

</div>

@stop