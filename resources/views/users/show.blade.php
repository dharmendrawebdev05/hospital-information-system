@extends('adminlte::page')

@section('title','User Profile')

@section('content')

<div class="container-fluid mt-3">

<div class="row">

{{-- LEFT PROFILE CARD --}}
<div class="col-md-4">

<div class="card card-outline card-primary">

<div class="card-body text-center">

<img src="https://ui-avatars.com/api/?name={{ $user->name }}&size=120"
class="img-circle elevation-2 mb-3">

<h4>{{ $user->name }}</h4>

<p class="text-muted">{{ $user->email }}</p>

<span class="badge badge-success">
Active User
</span>

</div>

</div>

</div>

{{-- RIGHT DETAILS --}}
<div class="col-md-8">

<div class="card card-outline card-info">

<div class="card-header">
<h3 class="card-title">User Details</h3>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">
<strong>Name:</strong>
<p>{{ $user->name }}</p>
</div>

<div class="col-md-6 mb-3">
<strong>Email:</strong>
<p>{{ $user->email }}</p>
</div>

<div class="col-md-6 mb-3">
<strong>Roles:</strong>
<p>
@foreach($user->getRoleNames() as $role)
<span class="badge badge-primary">{{ $role }}</span>
@endforeach
</p>
</div>

<div class="col-md-6 mb-3">
<strong>Created At:</strong>
<p>{{ $user->created_at->format('d M Y') }}</p>
</div>

</div>

</div>

<div class="card-footer text-right">

<a href="{{ route('users.edit', $user->id) }}"
class="btn btn-warning">

Edit User
</a>

<a href="{{ route('users.index') }}"
class="btn btn-secondary">

Back
</a>

</div>

</div>

</div>

</div>

</div>

@stop