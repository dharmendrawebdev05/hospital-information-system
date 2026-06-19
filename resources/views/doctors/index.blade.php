@extends('adminlte::page')

@section('title','Doctors')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">

<div class="d-flex justify-content-between">

<h3 class="card-title">
Doctors Master
</h3>

<a href="{{ route('doctors.create') }}"
class="btn btn-primary btn-sm">

Add Doctor

</a>

</div>

</div>

<div class="card-body">

<table class="table table-bordered table-striped"
id="doctorTable">

<thead>

<tr>
<th>#</th>
<th>Name</th>
<th>Email ID</th>
<th>Department</th>
<th>Mobile</th>
<th>Fee</th>
<th width="220">Action</th>
</tr>

</thead>

</table>

</div>

</div>

@stop

@push('js')

<script>

$(function () {

$('#doctorTable').DataTable({

processing: true,
serverSide: true,
responsive: true,

ajax: "{{ route('doctors.index') }}",

columns: [

{
data: 'DT_RowIndex',
name: 'DT_RowIndex',
orderable: false,
searchable: false
},

{
data: 'doctor_name',
name: 'doctor_name'
},

{
data: 'email',
name: 'email'
},

{
data: 'department',
name: 'department'
},

{
data: 'mobile',
name: 'mobile'
},

{
data: 'consultation_fee',
name: 'consultation_fee'
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