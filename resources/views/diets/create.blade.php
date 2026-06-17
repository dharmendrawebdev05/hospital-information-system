@extends('adminlte::page')

@section('title', 'Diet Master')

@section('content')

<div class="card mt-3 card-outline card-primary">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-utensils"></i>
Add Diet
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
action="{{ route('diets.store') }}">

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

<div class="alert alert-success alert-dismissible">

{{ session('success') }}

<button type="button"
class="close"
data-dismiss="alert">

<span>&times;</span>

</button>

</div>

@endif

<div class="row">

<div class="col-md-6">

<label>Diet Name</label>

<input type="text"
name="diet_name"
value="{{ old('diet_name') }}"
class="form-control"
required>

</div>

<div class="col-md-6">

<label>Category</label>

<select name="category"
class="form-control select2"
required>

<option value="">
Select Category
</option>

<option value="Normal">Normal</option>
<option value="Liquid">Liquid</option>
<option value="Soft">Soft</option>
<option value="Diabetic">Diabetic</option>
<option value="Cardiac">Cardiac</option>
<option value="Renal">Renal</option>
<option value="High Protein">High Protein</option>
<option value="Low Salt">Low Salt</option>
<option value="Low Fat">Low Fat</option>

</select>

</div>

<div class="col-md-12 mt-3">

<label>Description</label>

<textarea name="description"
rows="4"
class="form-control">{{ old('description') }}</textarea>

</div>

<div class="col-md-4 mt-3">

<label>Status</label>

<select name="status"
class="form-control"
required>

<option value="Active">
Active
</option>

<option value="Inactive">
Inactive
</option>

</select>

</div>

</div>

</div>

<div class="card-footer">

<button type="submit"
class="btn btn-success">

<i class="fas fa-save"></i>
Save Diet

</button>

<a href="{{ route('diets.index') }}"
class="btn btn-default">

Cancel

</a>

</div>

</form>

</div>

@stop