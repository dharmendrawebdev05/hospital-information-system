@extends('adminlte::page')

@section('title','Procedure Master')

@section('content')

<div class="card mt-3 card-outline card-primary">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-procedures"></i>
Add Procedure
</h3>
</div>

<form method="POST" action="{{ route('procedures.store') }}">

@csrf

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

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
{{ session('success') }}

<button type="button"
class="close"
data-dismiss="alert">
<span>&times;</span>
</button>
</div>
@endif

<div class="row">

<div class="col-md-4">
<label>Procedure Name</label>

<input type="text"
name="procedure_name"
value="{{ old('procedure_name') }}"
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
{{ old('department_id') == $department->id ? 'selected' : '' }}>
{{ $department->name }}
</option>
@endforeach

</select>
</div>

<div class="col-md-4">
<label>Category</label>

<select name="category"
class="form-control select2">

<option value="">Select Category</option>

<option value="Minor">Minor</option>
<option value="Major">Major</option>
<option value="Diagnostic">Diagnostic</option>
<option value="Therapeutic">Therapeutic</option>
<option value="Surgical">Surgical</option>

</select>
</div>

<div class="col-md-4 mt-3">
<label>Charges</label>

<input type="number"
name="charges"
value="{{ old('charges') }}"
class="form-control">
</div>

<div class="col-md-8 mt-3">
<label>Description</label>

<textarea name="description"
rows="3"
class="form-control">{{ old('description') }}</textarea>
</div>

<div class="col-md-4 mt-3">
<label>Status</label>

<select name="status"
class="form-control">

<option value="Active">Active</option>
<option value="Inactive">Inactive</option>

</select>
</div>

</div>

</div>

<div class="card-footer">

<button type="submit"
class="btn btn-success">
<i class="fas fa-save"></i>
Save Procedure
</button>

<a href="{{ route('procedures.index') }}"
class="btn btn-secondary">
Back
</a>

</div>

</form>

</div>

@stop