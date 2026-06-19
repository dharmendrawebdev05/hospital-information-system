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

<th>Appointment no</th>
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


<div class="modal fade" id="checkinModal" tabindex="-1">

<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">OPD Check-In</h5>
</div>

<!-- Print Area Start -->
<div class="modal-body" id="printArea">

<div class="text-center mb-3">
<h4>OPD TOKEN</h4>
</div>

<p><b>Token No:</b> <span id="tokenNo"></span></p>

<p><b>Visit No:</b> <span id="visitNo"></span></p>

<p><b>Patient:</b> <span id="patientName"></span></p>

<p><b>Doctor:</b> <span id="doctorName"></span></p>

</div>
<!-- Print Area End -->

<div class="modal-footer">

<button type="button"
class="btn btn-primary"
onclick="printTokenSlip()">
Print
</button>

<button type="button"
class="btn btn-secondary"
data-dismiss="modal">
Close
</button>

</div>

</div>
</div>

</div>


@stop


@push('js')
<script>
$(function () {

$('#checkinModal').on('hidden.bs.modal', function () {
    location.reload();
});
    

$('#appointmentTable').DataTable({

processing: true,
serverSide: true,
responsive: true,

ajax: "{{ route('appointments.index') }}",

columns: [



{
data: 'appointment_no',
name: 'appointment_no'
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



$(document).on('click', '.opd-checkin', function(e){

e.preventDefault();

let url = $(this).attr('href');

$.get(url, function(res){

console.log(res); // 🔥 debug

if(!res.status){
alert(res.message);
return;
}

$('#tokenNo').text(res.data.token_no);
$('#visitNo').text(res.data.visit_no);
$('#patientName').text(res.data.patient);
$('#doctorName').text(res.data.doctor);

$('#checkinModal').modal('show');
});
});




$(document).on('click', '.print-token', function(e){

e.preventDefault();

let url = $(this).attr('href');

$.get(url, function(res){

$('#tokenNo').text(res.data.token_no);
$('#visitNo').text(res.data.visit_no);
$('#patientName').text(res.data.patient);
$('#doctorName').text(res.data.doctor);

$('#checkinModal').modal('show');
});

});


});

function printTokenSlip()
{
var content = document.getElementById('printArea').innerHTML;

var win = window.open('', '', 'width=400,height=600');

win.document.write(`
<html>
<head>
<title>OPD Token</title>
</head>
<body>
${content}
</body>
</html>
`);

win.document.close();
win.focus();

win.print();

win.close();
$('#checkinModal').modal('hide');
setTimeout(function () {
location.reload();
}, 500);



}




</script>
@endpush