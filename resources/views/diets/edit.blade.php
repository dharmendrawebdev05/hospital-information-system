@extends('adminlte::page')

@section('title', 'Edit Diet')

@section('content')

<div class="card mt-3 card-outline card-warning">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-edit"></i>
Edit Diet
</h3>

<div class="card-tools">

<a href="{{ route('diets.index') }}"
class="btn btn-secondary btn-sm">

<i class="fas fa-arrow-left"></i>
Back

</a>

</div>

</div>

<form method="POST"
action="{{ route('diets.update', $diet->id) }}">

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

<div class="col-md-6">

<label>Diet Name</label>

<input type="text"
name="diet_name"
value="{{ old('diet_name', $diet->diet_name) }}"
class="form-control"
required>

</div>

<div class="col-md-6">

<label>Category</label>

<select name="category"
class="form-control select2"
required>

<option value="Normal"
{{ old('category', $diet->category) == 'Normal' ? 'selected' : '' }}>
Normal
</option>

<option value="Liquid"
{{ old('category', $diet->category) == 'Liquid' ? 'selected' : '' }}>
Liquid
</option>

<option value="Soft"
{{ old('category', $diet->category) == 'Soft' ? 'selected' : '' }}>
Soft
</option>

<option value="Diabetic"
{{ old('category', $diet->category) == 'Diabetic' ? 'selected' : '' }}>
Diabetic
</option>

<option value="Cardiac"
{{ old('category', $diet->category) == 'Cardiac' ? 'selected' : '' }}>
Cardiac
</option>

<option value="Renal"
{{ old('category', $diet->category) == 'Renal' ? 'selected' : '' }}>
Renal
</option>

<option value="High Protein"
{{ old('category', $diet->category) == 'High Protein' ? 'selected' : '' }}>
High Protein
</option>

<option value="Low Salt"
{{ old('category', $diet->category) == 'Low Salt' ? 'selected' : '' }}>
Low Salt
</option>

<option value="Low Fat"
{{ old('category', $diet->category) == 'Low Fat' ? 'selected' : '' }}>
Low Fat
</option>

</select>

</div>

<div class="col-md-12 mt-3">

<label>Description</label>

<textarea name="description"
rows="4"
class="form-control">{{ old('description', $diet->description) }}</textarea>

</div>

<div class="col-md-4 mt-3">

<label>Status</label>

<select name="status"
class="form-control">

<option value="Active"
{{ old('status', $diet->status) == 'Active' ? 'selected' : '' }}>
Active
</option>

<option value="Inactive"
{{ old('status', $diet->status) == 'Inactive' ? 'selected' : '' }}>
Inactive
</option>

</select>

</div>

</div>

</div>

<div class="card-footer">

<button type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>
Update Diet

</button>

<a href="{{ route('diets.index') }}"
class="btn btn-default">

Cancel

</a>

</div>

</form>

</div>

@stop