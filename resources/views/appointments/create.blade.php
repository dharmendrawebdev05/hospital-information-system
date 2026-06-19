@extends('adminlte::page')

@section('title','Book Appointment')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h3>Book Appointment</h3>
</div>

<form method="POST" action="{{ route('appointments.store') }}">
@csrf

<div class="card-body">

@if($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
{{ session('success') }}

<button type="button"
class="close"
data-dismiss="alert">
<span>&times;</span>
</button>
</div>
@endif



<div class="row">

<div class="col-md-4">
<label>Patient</label>
<select name="patient_id" class="form-control" required>
<option value="">Select Patient</option>

@foreach($patients as $patient)
<option value="{{ $patient->id }}"
{{ old('patient_id') == $patient->id ? 'selected' : '' }}>
{{ $patient->patient_name }}
</option>
@endforeach
</select>

@error('patient_id')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="col-md-4">
<label>Doctor</label>
<select name="doctor_id"
id="doctor_id"
class="form-control"
required>

<option value="">Select Doctor</option>

@foreach($doctors as $doctor)
<option value="{{ $doctor->id }}"
{{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
{{ $doctor->doctor_name }}
</option>
@endforeach
</select>

@error('doctor_id')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="col-md-4">
<label>Appointment Date</label>

<input type="date"
name="appointment_date"
id="appointment_date"
class="form-control"
min="{{ date('Y-m-d') }}"
value="{{ old('appointment_date') }}"
required>

@error('appointment_date')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

</div>

<hr>

<h5>Available Slots</h5>

<div id="slot-container">
<div class="alert alert-info">
Please select Doctor and Date.
</div>
</div>

<input type="hidden"
name="appointment_time"
id="appointment_time"
value="{{ old('appointment_time') }}">

<input type="hidden"
name="doctor_schedule_session_id"
id="doctor_schedule_session_id"
value="{{ old('doctor_schedule_session_id') }}">

</div>

<div class="card-footer">
<button type="submit" class="btn btn-success">
Book Appointment
</button>
</div>

</form>



</div>

@stop

@section('css')

<style>

.slot-btn{
margin:5px;
min-width:120px;
}

.session-card{
margin-bottom:20px;
}

</style>

@stop

@section('js')

<script>

function loadSlots()
{
let doctorId = $('#doctor_id').val();
let date = $('#appointment_date').val();

if (!doctorId || !date) return;

$.ajax({
url: "{{ route('appointments.slots') }}",
type: 'GET',
dataType: 'json',
data: {
doctor_id: doctorId,
appointment_date: date
},

success: function(response) {

let html = '';

if (response.length === 0) {
html = `
<div class="alert alert-danger">
Doctor is not available on selected date.
</div>
`;
$('#slot-container').html(html);
return;
}

response.forEach(function(session) {

html += `
<div class="card session-card mb-3">
<div class="card-header">
<strong>${session.session_name}</strong>
(${session.start_time} - ${session.end_time})
</div>

<div class="card-body">
`;

session.slots.forEach(function(slot) {

if (slot.status === 'booked') {
html += `
<button type="button"
class="btn btn-danger slot-btn"
disabled
title="Already booked"
style="pointer-events:none; opacity:0.7;">
${slot.display}
</button>
`;
} else {
html += `
<button type="button"
class="btn btn-outline-success slot-btn"
data-time="${slot.time}"
data-session="${session.session_id}">
${slot.display}
</button>
`;
}

});

html += `
</div>
</div>
`;
});

$('#slot-container').html(html);
},

error: function(xhr) {
console.log("AJAX ERROR:", xhr.responseText);
}
});
}

// triggers
$('#doctor_id').change(loadSlots);
$('#appointment_date').change(loadSlots);

// reload old values
@if(old('doctor_id') && old('appointment_date'))
loadSlots();
@endif

// SLOT CLICK HANDLER
$(document).on('click', '.slot-btn', function() {

if ($(this).prop('disabled')) return;

$('.slot-btn')
.removeClass('btn-success')
.addClass('btn-outline-success');

$(this)
.removeClass('btn-outline-success')
.addClass('btn-success');

$('#appointment_time').val($(this).data('time'));
$('#doctor_schedule_session_id').val($(this).data('session'));
});

</script>

@stop