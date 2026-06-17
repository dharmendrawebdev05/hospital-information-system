@extends('adminlte::page')

@section('title','Lab Tests')

@section('content')

<div class="card card-outline card-primary">

<div class="card-header">

<div class="d-flex justify-content-between align-items-center">

<h3 class="card-title">
<i class="fas fa-vial"></i> Lab Tests Master
</h3>

<a href="{{ route('lab-tests.create') }}"
class="btn btn-primary btn-sm">

<i class="fas fa-plus"></i>
Add Test

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-striped"
id="labTestTable">

<thead>

<tr>
<th>#</th>
<th>Test Name</th>
<th>Price</th>
<th>Sample Type</th>
<th width="180">Action</th>
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

$('#labTestTable').DataTable({

processing: true,
serverSide: true,
responsive: true,

ajax: "{{ route('lab-tests.index') }}",

columns: [

{
data: 'DT_RowIndex',
name: 'DT_RowIndex',
orderable: false,
searchable: false
},

{
data: 'test_name',
name: 'test_name'
},

{
data: 'price',
name: 'price'
},

{
data: 'sample_type',
name: 'sample_type'
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

@endpush