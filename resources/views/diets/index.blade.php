@extends('adminlte::page')

@section('title', 'Diet Master')

@section('content')

<div class="card mt-3 card-outline card-primary">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-utensils"></i>
Diet Master
</h3>

<div class="card-tools">

<a href="{{ route('diets.create') }}"
class="btn btn-primary btn-sm">

<i class="fas fa-plus"></i>
Add Diet

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

<table id="dietTable"
class="table table-bordered table-striped">

<thead>

<tr>

<th>#</th>
<th>Code</th>
<th>Diet Name</th>
<th>Category</th>
<th>Status</th>
<th width="180">Action</th>

</tr>

</thead>

</table>

</div>

</div>

@stop

@section('js')

<script>

$(function () {

$('#dietTable').DataTable({

processing: true,
serverSide: true,

ajax: "{{ route('diets.index') }}",

columns: [

{
data: 'DT_RowIndex',
name: 'DT_RowIndex',
orderable: false,
searchable: false
},

{
data: 'diet_code',
name: 'diet_code'
},

{
data: 'diet_name',
name: 'diet_name'
},

{
data: 'category',
name: 'category'
},

{
data: 'status',
name: 'status',
render: function(data){

if(data == 'Active'){
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