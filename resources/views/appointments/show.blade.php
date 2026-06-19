@extends('adminlte::page')

@section('title','Appointment Details')

@section('content')

<div class="container-fluid mt-3">

<div class="row">

{{-- LEFT INFO CARD --}}
<div class="col-md-4">

<div class="card card-outline card-primary shadow-sm">

<div class="card-body text-center">

<img src="https://ui-avatars.com/api/?name={{ $appointment->patient->patient_name }}&size=120"
class="img-circle elevation-2 mb-3">

<h4>{{ $appointment->patient->patient_name }}</h4>

<p class="text-muted">Patient</p>

<span class="badge badge-success">
{{ $appointment->status }}
</span>

</div>

</div>

</div>

{{-- RIGHT DETAILS --}}
<div class="col-md-8">

<div class="card card-outline card-info shadow-sm">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-calendar-check"></i> Appointment Details
</h3>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">
<strong>Patient Name</strong>
<p>{{ $appointment->patient->patient_name }}</p>
</div>

<div class="col-md-6 mb-3">
<strong>Doctor</strong>
<p>{{ $appointment->doctor->doctor_name }}</p>
</div>

<div class="col-md-6 mb-3">
<strong>Appointment Date</strong>
<p>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</p>
</div>



<div class="col-md-6 mb-3">
<strong>Consultation Fee</strong>
<p>
<span class="text-success font-weight-bold">
₹ {{ number_format($appointment->consultation_fee, 2) }}
</span>
</p>
</div>

<div class="col-md-6 mb-3">
<strong>Status</strong>
<p>
@if($appointment->status == 'Booked')
<span class="badge badge-info">Booked</span>
@elseif($appointment->status == 'Completed')
<span class="badge badge-success">Completed</span>
@elseif($appointment->status == 'Cancelled')
<span class="badge badge-danger">Cancelled</span>
@else
<span class="badge badge-secondary">{{ $appointment->status }}</span>
@endif
</p>
</div>

</div>

</div>

{{-- FOOTER ACTIONS --}}
<div class="card-footer text-right">

<a href="{{ route('appointments.index') }}"
class="btn btn-secondary">

Back
</a>

<a href="{{ route('appointments.edit', $appointment->id) }}"
class="btn btn-warning">

Edit Appointment
</a>

</div>

</div>

</div>

</div>

</div>

@stop