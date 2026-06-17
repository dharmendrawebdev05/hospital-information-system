@extends('adminlte::page')

@section('title', 'Procedure Master')

@section('content')

<div class="card mt-3 card-outline card-primary">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-procedures"></i>
Procedure Master
</h3>

<div class="card-tools">

<a href="{{ route('procedures.create') }}"
class="btn btn-primary btn-sm">

<i class="fas fa-plus"></i>
Add Procedure

</a>

</div>

</div>

<div class="card-body">

@if(session('success'))

<div class="alert alert-success alert-dismissible">

{{ session('success') }}

<button type="button"
class="close"
data-dismiss="alert">

<span>&times;</span>

</button>

</div>

@endif

<div class="table-responsive">

<table id="procedureTable"
class="table table-bordered table-striped">

<thead>

<tr>

<th>#</th>
<th>Code</th>
<th>Procedure Name</th>
<th>Department</th>
<th>Category</th>
<th>Charges</th>
<th>Status</th>
<th width="180">Action</th>

</tr>

</thead>

</table>

</div>

</div>

</div>

@stop


@section('js')

<script>

$(function () {

$('#procedureTable').DataTable({

processing: true,
serverSide: true,

ajax: "{{ route('procedures.index') }}",

columns: [

{
data: 'DT_RowIndex',
name: 'DT_RowIndex',
orderable: false,
searchable: false
},

{
data: 'procedure_code',
name: 'procedure_code'
},

{
data: 'procedure_name',
name: 'procedure_name'
},

{
data: 'department',
name: 'department'
},

{
data: 'category',
name: 'category'
},

{
data: 'charges',
name: 'charges'
},

{
data: 'status',
name: 'status',
render: function(data) {

if(data == 'Active') {

return '<span class="badge badge-success">Active</span>';

}

return '<span class="badge badge-danger">Inactive</span>';

}
},

{
data: 'action',
name: 'action',
orderable: false,
searchable: false
}

]

});

});

</script>

@stop																		