@extends('adminlte::page')

@section('title','Doctor Schedule')

@section('content')

<div class="card card-outline card-primary mt-3">

<div class="card-header">

<div class="d-flex justify-content-between align-items-center">

<h3 class="card-title">
<i class="fas fa-calendar-alt"></i>
Doctor Schedule Master
</h3>

<a href="{{ route('doctor-schedules.create') }}"
class="btn btn-primary btn-sm">

<i class="fas fa-plus"></i>
Add Schedule

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-striped"
id="scheduleTable">

<thead>

<tr>
<th>#</th>
<th>Doctor</th>
<th>Day</th>
<th>Action</th>
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

$('#scheduleTable').DataTable({

processing: true,
serverSide: true,
responsive: true,

ajax: "{{ route('doctor-schedules.index') }}",

columns: [

{
data: 'DT_RowIndex',
name: 'DT_RowIndex',
orderable: false,
searchable: false
},

{
data: 'doctor_name',
name: 'doctor.doctor_name'
},

{
data: 'day_name',
name: 'day_name'
},

{
data: 'action',
name: 'action',
orderable: false,
searchable: false,
width: '250px'
}

]

});

});

</script>

@endpush