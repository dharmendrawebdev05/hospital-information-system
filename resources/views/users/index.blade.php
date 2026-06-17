@extends('adminlte::page')

@section('title','Users')

@section('content')

<div class="card card-outline card-primary mt-3">

<div class="card-header">

<div class="d-flex justify-content-between">

<h3 class="card-title">Users List</h3>

<a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
Add User
</a>

</div>

{{-- ROLE FILTER --}}

</div>

<div class="card-body">

<table id="usersTable" class="table table-bordered table-striped">

<thead>
<tr>
<th>#</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

</table>

</div>

</div>

@stop

@push('js')

<script>

$(function () {

let table = $('#usersTable').DataTable({

processing: true,
serverSide: true,
responsive: true,

ajax: {
url: "{{ route('users.index') }}",

},

columns: [
{data: 'DT_RowIndex', name: 'id', orderable: false, searchable: false},
{data: 'name', name: 'name'},
{data: 'email', name: 'email'},
{data: 'role', name: 'role', orderable: false, searchable: false},
{data: 'status', name: 'status', orderable: false, searchable: false},
{data: 'action', name: 'action', orderable: false, searchable: false},
]
});



});

</script>

@endpush