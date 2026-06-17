@extends('adminlte::page')

@section('title','Add Lab Test')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-body">

<form method="POST" action="{{ route('lab-tests.store') }}">
@csrf

<input type="text" name="test_name" class="form-control mb-2" placeholder="Test Name">

<input type="number" name="price" class="form-control mb-2" placeholder="Price">

<input type="text" name="sample_type" class="form-control mb-2" placeholder="Sample Type">

<textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>

<button class="btn btn-success">Save</button>

</form>

</div>

</div>

@stop