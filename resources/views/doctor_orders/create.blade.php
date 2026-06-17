@extends('adminlte::page')

@section('title', 'Create Doctor Order')

@section('content_header')
<h1>Create Doctor Order</h1>
@stop

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h3 class="card-title">
Patient: {{ $admission->patient->patient_name ?? '' }}
</h3>
</div>

<form action="{{ route('ipd.orders.store', $admission->id) }}"
method="POST">

@csrf

<div class="card-body">

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

<div class="col-md-6">
<div class="form-group">

<label>Order Type</label>

<select name="order_type"
class="form-control"
required>

<option value="">
Select Type
</option>

<option value="lab">
Lab Test
</option>

<option value="radiology">
Radiology
</option>

<option value="medicine">
Medicine
</option>

<option value="procedure">
Procedure
</option>

<option value="diet">
Diet
</option>

</select>

</div>
</div>

<div class="col-md-6">
<div class="form-group">

<label>Order Name</label>

<input type="text"
name="order_name"
class="form-control"
placeholder="Enter Order Name"
required>

</div>
</div>

</div>

<div class="form-group">

<label>Instructions</label>

<textarea name="instructions"
class="form-control"
rows="5"
placeholder="Doctor instructions"></textarea>

</div>

</div>

<div class="card-footer">

<button type="submit"
class="btn btn-primary">

Save Order

</button>

<a href="{{ route('ipd.orders.index', $admission->id) }}"
class="btn btn-secondary">

Back

</a>

</div>

</form>

</div>

@stop