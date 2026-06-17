@extends('adminlte::page')

@section('title','Edit Lab Test')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-body">

<form method="POST" action="{{ route('lab-tests.update',$test->id) }}">
@csrf @method('PUT')

<input type="text" name="test_name" value="{{ $test->test_name }}" class="form-control mb-2">

<input type="number" name="price" value="{{ $test->price }}" class="form-control mb-2">

<input type="text" name="sample_type" value="{{ $test->sample_type }}" class="form-control mb-2">

<textarea name="description" class="form-control mb-2">{{ $test->description }}</textarea>

<button class="btn btn-success">Update</button>

</form>

</div>

</div>

@stop