@extends('adminlte::page')

@section('title', 'Create Department')

@section('content_header')
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">Create Department</h4>
<small class="text-muted">Configure Hospital Department</small>
</div>

<a href="{{ route('departments.index') }}" class="btn btn-outline-secondary btn-sm">
← Back
</a>
</div>
@stop

@section('content')

<div class="card mt-3  card-outline card-primary">

<form action="{{ route('departments.store') }}" method="POST">
@csrf

<div class="card-body">

{{-- Errors --}}
@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="row">

{{-- Department Name --}}
<div class="col-md-6">
<div class="form-group">
<label>Department Name *</label>
<input type="text"
name="name"
class="form-control"
placeholder="e.g. Radiology, Cardiology"
value="{{ old('name') }}"
required>
</div>
</div>

{{-- Department Code --}}
<div class="col-md-6">
<div class="form-group">
<label>Department Code *</label>
<input type="text"
name="code"
class="form-control"
placeholder="e.g. RAD, CAR, SUR"
value="{{ old('code') }}"
required>
</div>
</div>

</div>

{{-- Description --}}
<div class="form-group">
<label>Description</label>
<textarea name="description"
class="form-control"
rows="4"
placeholder="Optional description">{{ old('description') }}</textarea>
</div>

</div>

<div class="card-footer d-flex justify-content-between">

<a href="{{ route('departments.index') }}" class="btn btn-secondary">
Back
</a>

<button type="submit" class="btn btn-primary">
Save Department
</button>

</div>

</form>

</div>

@stop