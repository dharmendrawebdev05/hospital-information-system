@extends('adminlte::page')

@section('title','Appointments')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">

<div class="d-flex justify-content-between">

<h3 class="card-title">
Appointments
</h3>

@can('appointment.create')
<a href="{{ route('appointments.create') }}"
   class="btn btn-primary btn-sm">
    Book Appointment
</a>
@endcan

</div>

</div>

<div class="card-body">

<table class="table table-bordered table-striped"
id="appointmentTable">

<thead>
<tr>

<th>Token</th>
<th>Patient</th>
<th>Doctor</th>
<th>Date</th>
<th>Time</th>
<th>Fee</th>
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
$(function () {

$('#appointmentTable').DataTable({

processing: true,
serverSide: true,
responsive: true,

ajax: "{{ route('appointments.index') }}",

columns: [



{
data: 'token_no',
name: 'token_no'
},

{
data: 'patient_name',
name: 'patient.patient_name'
},

{
data: 'doctor_name',
name: 'doctor.doctor_name'
},

{
data: 'appointment_date',
name: 'appointment_date'
},

{
data: 'appointment_time',
name: 'appointment_time'
},

{
data: 'consultation_fee',
name: 'consultation_fee'
},

{
data: 'status',
name: 'status'
},

{
data: 'action',
name: 'action',
orderable: false,
searchable: false,
width:'350px'
}
]

});

});
</script>
@endpush