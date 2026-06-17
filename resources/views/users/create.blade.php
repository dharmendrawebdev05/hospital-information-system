@extends('adminlte::page')

@section('title','Create User')

@section('content')

<div class="container-fluid mt-3">

<form action="{{ route('users.store') }}" method="POST">
@csrf

<div class="card card-outline card-primary shadow-sm">

{{-- HEADER --}}
<div class="card-header">
<h3>Create New User</h3>
</div>

<div class="card-body">

<div class="row">

{{-- LEFT PROFILE PREVIEW --}}
<div class="col-md-4 text-center">

<img src="https://ui-avatars.com/api/?name=New+User&size=120"
class="img-circle elevation-2 mb-3">

<h5>New User Profile</h5>

<p class="text-muted">Fill details to create account</p>

</div>

{{-- RIGHT FORM --}}
<div class="col-md-8">

<div class="row">

{{-- NAME --}}
<div class="col-md-6">
<label>Name</label>
<input type="text"
name="name"
class="form-control"
placeholder="Enter full name">
</div>

{{-- EMAIL --}}
<div class="col-md-6">
<label>Email</label>
<input type="email"
name="email"
class="form-control"
placeholder="Enter email">
</div>

{{-- PASSWORD --}}
<div class="col-md-6 mt-3">
<label>Password</label>
<input type="password"
name="password"
class="form-control"
placeholder="Enter password">
</div>

{{-- ROLE --}}
<div class="col-md-6 mt-3">
<label>Role</label>

<select name="role" class="form-control">

<option value="">Select Role</option>

@foreach($roles as $role)
<option value="{{ $role->name }}">
{{ $role->name }}
</option>
@endforeach

</select>

</div>

</div>

{{-- INFO BOX --}}
<div class="alert alert-info mt-4">
<i class="fas fa-info-circle"></i>
User will get system access after role assignment.
</div>

</div>

</div>

</div>

{{-- FOOTER --}}
<div class="card-footer text-right">

<a href="{{ route('users.index') }}"
class="btn btn-secondary">

Cancel
</a>

<button class="btn btn-success">
Create User
</button>

</div>

</div>

</form>

</div>

@stop