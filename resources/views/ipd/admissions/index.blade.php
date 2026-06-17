@extends('adminlte::page')

@section('title', 'IPD Admissions')

@section('content')

<div class="container-fluid mt-3">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 class="mb-0">IPD Admissions</h4>
<small class="text-muted">Manage inpatient admissions</small>
</div>
</div>

<!-- CARD -->
<div class="card card-outline card-primary">

<div class="card-header">
<h3 class="card-title">Admission List</h3>
</div>

<div class="card-body">

<table class="table table-bordered table-striped" id="ipd-table">

<thead>
<tr>
<th>#</th>
<th>Admission No</th>
<th>Patient</th>
<th>Doctor</th>
<th>Ward</th>
<th>Bed</th>
<th>Date</th>
<th>Status</th>
<th width="150">Action</th>
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

$('#ipd-table').DataTable({
processing: true,
serverSide: true,
ajax: "{{ route('ipd.admissions.index') }}",

columns: [
{ data: 'id', name: 'id' },
{ data: 'admission_no', name: 'admission_no' },
{ data: 'patient', name: 'patient', orderable:false },
{ data: 'doctor', name: 'doctor', orderable:false },
{ data: 'ward', name: 'ward', orderable:false },
{ data: 'bed', name: 'bed', orderable:false },
{ data: 'admission_date', name: 'admission_date' },
{ data: 'status', name: 'status', orderable:false, searchable:false },
{ data: 'action', name: 'action', orderable:false, searchable:false },
]
});

});
</script>

@stop