@extends('adminlte::page')

@section('title', 'Beds')

@section('content')

<div class="card mt-3 card-outline card-primary">

<div class="card-header">
<h3 class="card-title">Bed Management</h3>

<div class="card-tools">
<a href="{{ route('beds.create') }}" class="btn btn-primary btn-sm">
Add Bed
</a>
</div>
</div>

<div class="card-body">

<table class="table table-bordered table-striped" id="beds-table">

<thead>
<tr>
<th>#</th>
<th>Ward</th>
<th>Bed No</th>
<th>Room No</th>
<th>Status</th>
<th width="180">Action</th>
</tr>
</thead>

</table>

</div>
</div>

@stop

@section('js')

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(function () {

$('#beds-table').DataTable({
processing: true,
serverSide: true,
ajax: "{{ route('beds.index') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'ward_name', name: 'ward_name', orderable: false },
{ data: 'bed_no', name: 'bed_no' },
{ data: 'room_no', name: 'room_no' },
{ data: 'status', name: 'status', orderable: false, searchable: false },
{ data: 'action', name: 'action', orderable: false, searchable: false },
]
});

});
</script>

@stop