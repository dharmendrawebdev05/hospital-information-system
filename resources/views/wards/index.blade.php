@extends('adminlte::page')

@section('title', 'Wards')

@section('content')

<div class="card mt-3 card-outline card-primary">

<div class="card-header">
<h3 class="card-title">Ward Management</h3>

<div class="card-tools">
<a href="{{ route('wards.create') }}" class="btn btn-primary btn-sm">
Add Ward
</a>
</div>
</div>

<div class="card-body">

<table class="table table-bordered table-striped" id="wards-table">

<thead>
<tr>
<th>ID</th>
<th>Ward Name</th>
<th>Type</th>
<th>Floor</th>
<th>Total Beds</th>
<th>Status</th>
<th width="180">Action</th>
</tr>
</thead>

</table>

</div>
</div>

@stop

@section('js')

<!-- DataTables CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(function () {

$('#wards-table').DataTable({
processing: true,
serverSide: true,
ajax: "{{ route('wards.index') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'ward_name', name: 'ward_name' },
{ data: 'ward_type', name: 'ward_type' },
{ data: 'floor_no', name: 'floor_no' },
{ data: 'total_beds', name: 'total_beds' },
{ data: 'is_active', name: 'is_active', orderable: false, searchable: false },
{ data: 'action', name: 'action', orderable: false, searchable: false },
]
});

});
</script>

@stop