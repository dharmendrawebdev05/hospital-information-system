@extends('adminlte::page')

@section('title','Edit User')

@section('content')

<div class="container-fluid mt-3">

<div class="card card-outline card-primary shadow-sm">

{{-- HEADER --}}
<div class="card-header">
<h3>Edit User Profile</h3>
</div>

<form method="POST" action="{{ route('users.update', $user->id) }}">
@csrf
@method('PUT')

<div class="card-body">

<div class="row">

{{-- LEFT PROFILE --}}
<div class="col-md-4 text-center">

<img src="https://ui-avatars.com/api/?name={{ $user->name }}&size=120"
class="img-circle elevation-2 mb-3">

<h5>{{ $user->name }}</h5>

<span class="badge badge-info">User ID: {{ $user->id }}</span>

</div>

{{-- RIGHT FORM --}}
<div class="col-md-8">

<div class="form-group">
<label>Name</label>
<input type="text"
name="name"
value="{{ $user->name }}"
class="form-control">
</div>

<div class="form-group">
<label>Email</label>
<input type="email"
name="email"
value="{{ $user->email }}"
class="form-control">
</div>

{{-- ROLES --}}
<div class="form-group">
<label>Roles</label>

<div class="row">

@foreach($roles as $role)

<div class="col-md-4">

<div class="custom-control custom-checkbox">

<input type="checkbox"
name="roles[]"
value="{{ $role->name }}"
class="custom-control-input"
id="role{{ $role->id }}"
{{ $user->hasRole($role->name) ? 'checked' : '' }}>

<label class="custom-control-label"
for="role{{ $role->id }}">

{{ $role->name }}

</label>

</div>

</div>

@endforeach

</div>

</div>

</div>

</div>

</div>

<div class="card-footer text-right">

<a href="{{ route('users.index') }}"
class="btn btn-secondary">

Cancel
</a>

<button class="btn btn-success">
Update User
</button>

</div>

</form>

</div>

</div>

@stop