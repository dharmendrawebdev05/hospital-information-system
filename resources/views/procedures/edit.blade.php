@extends('adminlte::page')

@section('title','Edit Procedure')

@section('content')

<div class="card mt-3 card-outline card-warning">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-edit"></i>
Edit Procedure
</h3>

<div class="card-tools">
<a href="{{ route('procedures.index') }}"
class="btn btn-secondary btn-sm">
<i class="fas fa-arrow-left"></i> Back
</a>
</div>

</div>

<form method="POST"
action="{{ route('procedures.update', $procedure->id) }}">

@csrf
@method('PUT')

<div class="card-body">

@if($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="row">

<div class="col-md-4">
<label>Procedure Name</label>

<input type="text"
name="procedure_name"
value="{{ old('procedure_name', $procedure->procedure_name) }}"
class="form-control"
required>
</div>

<div class="col-md-4">
<label>Department</label>

<select name="department_id"
class="form-control select2"
required>

<option value="">Select Department</option>

@foreach($departments as $department)
<option value="{{ $department->id }}"
{{ old('department_id', $procedure->department_id) == $department->id ? 'selected' : '' }}>
{{ $department->name }}
</option>
@endforeach

</select>
</div>

<div class="col-md-4">
<label>Category</label>

<select name="category"
class="form-control select2"
required>

<option value="Minor"
{{ old('category', $procedure->category) == 'Minor' ? 'selected' : '' }}>
Minor
</option>

<option value="Major"
{{ old('category', $procedure->category) == 'Major' ? 'selected' : '' }}>
Major
</option>

<option value="Diagnostic"
{{ old('category', $procedure->category) == 'Diagnostic' ? 'selected' : '' }}>
Diagnostic
</option>

<option value="Therapeutic"
{{ old('category', $procedure->category) == 'Therapeutic' ? 'selected' : '' }}>
Therapeutic
</option>

<option value="Surgical"
{{ old('category', $procedure->category) == 'Surgical' ? 'selected' : '' }}>
Surgical
</option>

</select>
</div>

<div class="col-md-4 mt-3">
<label>Charges</label>

<input type="number"
step="0.01"
name="charges"
value="{{ old('charges', $procedure->charges) }}"
class="form-control">
</div>

<div class="col-md-4 mt-3">
<label>Status</label>

<select name="status"
class="form-control">

<option value="Active"
{{ old('status', $procedure->status) == 'Active' ? 'selected' : '' }}>
Active
</option>

<option value="Inactive"
{{ old('status', $procedure->status) == 'Inactive' ? 'selected' : '' }}>
Inactive
</option>

</select>
</div>

<div class="col-md-12 mt-3">
<label>Description</label>

<textarea name="description"
rows="3"
class="form-control">{{ old('description', $procedure->description) }}</textarea>
</div>

</div>

</div>

<div class="card-footer">

<button type="submit"
class="btn btn-primary">
<i class="fas fa-save"></i>
Update Procedure
</button>

</div>

</form>

</div>

@stop