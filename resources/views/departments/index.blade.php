@extends('adminlte::page')

@section('title', 'Departments')

@section('content')

<div class="card card-outline card-primary">

{{-- HEADER --}}
<div class="card-header">

<div class="d-flex justify-content-between align-items-center">

<h3 class="card-title">
<i class="fas fa-building"></i> Departments Master
</h3>

<a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">
<i class="fas fa-plus"></i> Add Department
</a>

</div>

</div>

{{-- BODY --}}
<div class="card-body">


{{-- TABLE --}}
<div class="table-responsive">

<table class="table table-hover table-striped table-bordered" id="deptTable">

<thead>
<tr>
<th>#</th>
<th>Department Name</th>
<th>Code</th>
<th>Status</th>
<th width="180px">Action</th>
</tr>
</thead>

</table>

</div>

</div>

</div>

@stop


@push('js')
<script>
$(function () {

let table = $('#deptTable').DataTable({
processing: true,
serverSide: true,
responsive: true,

ajax: {
url: "{{ route('departments.index') }}",
data: function (d) {
d.status = $('#statusFilter').val();
}
},

columns: [
{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

{ data: 'name', name: 'name' },

{ data: 'code', name: 'code' },

{ data: 'status', name: 'status', orderable: false, searchable: false },

{ data: 'action', name: 'action', orderable: false, searchable: false },
]
});

// 🔍 LIVE SEARCH
$('#searchBox').on('keyup', function () {
table.search(this.value).draw();
});

// 🔄 STATUS FILTER
$('#statusFilter').on('change', function () {
table.draw();
});

});
</script>

@endpush