@extends('adminlte::page')

@section('title', 'Procedure Details')

@section('content')

<div class="card mt-3 card-outline card-primary shadow">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-procedures"></i>
Procedure Details
</h3>

<div class="card-tools">
<a href="{{ route('procedures.index') }}"
class="btn btn-secondary btn-sm">
<i class="fas fa-arrow-left"></i>
Back
</a>
</div>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-4 text-center border-right">

<div class="mb-3">
<i class="fas fa-procedures fa-6x text-primary"></i>
</div>

<h4 class="font-weight-bold">
{{ $procedure->procedure_name }}
</h4>

<span class="badge badge-info p-2">
{{ $procedure->category }}
</span>

</div>

<div class="col-md-8">

<table class="table table-bordered table-striped">

<tr>
<th width="30%">Procedure Code</th>
<td>{{ $procedure->procedure_code }}</td>
</tr>

<tr>
<th>Procedure Name</th>
<td>{{ $procedure->procedure_name }}</td>
</tr>

<tr>
<th>Department</th>
<td>
{{ $procedure->department->department_name ?? '-' }}
</td>
</tr>

<tr>
<th>Category</th>
<td>
<span class="badge badge-primary">
{{ $procedure->category }}
</span>
</td>
</tr>

<tr>
<th>Charges</th>
<td>
₹ {{ number_format($procedure->charges, 2) }}
</td>
</tr>

<tr>
<th>Status</th>
<td>
@if($procedure->status == 'Active')
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
<th>Description</th>
<td>
{{ $procedure->description ?: '-' }}
</td>
</tr>

<tr>
<th>Created At</th>
<td>
{{ $procedure->created_at->format('d-m-Y h:i A') }}
</td>
</tr>

</table>

</div>

</div>

</div>

</div>

@stop                                                                