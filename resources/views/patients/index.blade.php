@extends('adminlte::page')

@section('title','Patients')

@section('content')

<div class="card card-outline card-primary mt-3">

<div class="card-header">

<div class="d-flex justify-content-between align-items-center">

<h3 class="card-title">
<i class="fas fa-user-injured"></i> Patients
</h3>

<a href="{{ route('patients.create') }}" class="btn btn-primary btn-sm">
<i class="fas fa-plus"></i> New Patient
</a>

</div>
</div>

<div class="card-body">


{{-- TABLE --}}
<div class="table-responsive">

<table class="table table-hover table-striped table-bordered" id="patientTable">

<thead>
<tr>
<th>UHID</th>
<th>Name</th>
<th>Mobile</th>
<th>Gender</th>
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

let table = $('#patientTable').DataTable({

processing: true,
serverSide: true,
responsive: true,

ajax: {
url: "{{ route('patients.index') }}",

},

columns: [

{ data: 'uhid', name: 'uhid' },

{ data: 'patient_name', name: 'patient_name' },

{ data: 'mobile', name: 'mobile' },

{ data: 'gender', name: 'gender' },

{ data: 'action', name: 'action', orderable: false, searchable: false },

]

});



});
</script>

@endpush