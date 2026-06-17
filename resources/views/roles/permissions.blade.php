@extends('adminlte::page')

@section('title','Role Permissions')

@section('content')


<div class="card mt-3  card-outline card-primary">

<div class="card-header">

<h3>

{{ $role->name }}

Permissions

</h3>

</div>

<form method="POST"
action="{{ route('roles.permissions.update',$role->id) }}">

@csrf

<div class="card-body">

<div class="row">

@foreach($permissions as $permission)

<div class="col-md-3">

<label>

<input type="checkbox"
name="permissions[]"
value="{{ $permission->name }}"

{{ $role->hasPermissionTo($permission->name)
? 'checked'
: '' }}

>

{{ $permission->name }}

</label>

</div>

@endforeach

</div>

</div>

<div class="card-footer">

<button class="btn btn-success">

Save Permissions

</button>

</div>

</form>

</div>

@stop