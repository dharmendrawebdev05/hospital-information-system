@extends('adminlte::page')

@section('title','Radiology Tests')

@section('content')

<div class="card card-outline card-primary mt-3">

<div class="card-header">

<div class="d-flex justify-content-between">

<h3 class="card-title">
Radiology Master
</h3>

<a href="{{ route('radiology-tests.create') }}"
class="btn btn-primary btn-sm">

Add Test

</a>

</div>

</div>

<div class="card-body">

<table id="testTable"
class="table table-bordered table-striped">

<thead>

<tr>
<th>#</th>
<th>Code</th>
<th>Test Name</th>
<th>Modality</th>
<th>Price</th>
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

$('#testTable').DataTable({

processing:true,
serverSide:true,

ajax:'{{ route("radiology-tests.index") }}',

columns:[

{
data:'DT_RowIndex',
searchable:false,
orderable:false
},

{
data:'test_code',
name:'test_code'
},

{
data:'test_name',
name:'test_name'
},

{
data:'modality',
name:'modality'
},

{
data:'price',
name:'price'
},

{
data:'status',
name:'is_active'
},

{
data:'action',
searchable:false,
orderable:false
}
]
});

</script>

@endpush