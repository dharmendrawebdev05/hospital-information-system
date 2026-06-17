@extends('adminlte::page')

@section('title','Roles')

@section('content')

<div class="card mt-3  card-outline card-primary">

    <div class="card-header">
        <h3>Roles</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role Name</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($roles as $role)

<tr>
<td>{{ $role->id }}</td>
<td>{{ $role->name }}</td>
<td>

<a href="{{ route(
'roles.permissions',
$role->id
) }}"

class="btn btn-primary btn-sm">

Permissions

</a>

</td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop