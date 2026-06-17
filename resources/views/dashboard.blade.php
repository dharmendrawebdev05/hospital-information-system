@extends('adminlte::page')

@section('title', 'Hospital Dashboard')

@section('content_header')

<div class="row mb-3">


<div class="col-md-8">

<h2 class="font-weight-bold">
<i class="fas fa-hospital-alt text-primary"></i>
Hospital Information System



</h2>

<p class="text-muted mb-0">
Welcome back, {{ auth()->user()->name }}
</p>

</div>

<div class="col-md-4 text-right">

<div class="mt-2">

<span class="badge badge-primary p-2">
{{ now()->format('d M Y') }}
</span>

</div>

</div>


</div>

@stop

@section('content')

<div class="row">


{{-- PATIENTS --}}
<div class="col-lg-3 col-md-6">

<div class="card bg-gradient-primary elevation-3">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>
<h2>{{ $patients }}</h2>
<p class="mb-0">Total Patients</p>
</div>

<div>
<i class="fas fa-user-injured fa-3x"></i>
</div>

</div>

</div>

</div>

</div>

{{-- APPOINTMENTS --}}
<div class="col-lg-3 col-md-6">

<div class="card bg-gradient-success elevation-3">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>
<h2>{{ $appointments }}</h2>
<p class="mb-0">Appointments</p>
</div>

<div>
<i class="fas fa-calendar-check fa-3x"></i>
</div>

</div>

</div>

</div>

</div>

{{-- DOCTORS --}}
<div class="col-lg-3 col-md-6">

<div class="card bg-gradient-warning elevation-3">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>
<h2>{{ $doctors }}</h2>
<p class="mb-0">Doctors</p>
</div>

<div>
<i class="fas fa-user-md fa-3x"></i>
</div>

</div>

</div>

</div>

</div>

{{-- REVENUE --}}
<div class="col-lg-3 col-md-6">

<div class="card bg-gradient-danger elevation-3">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>
<h2>₹{{ number_format($revenue) }}</h2>
<p class="mb-0">Revenue</p>
</div>

<div>
<i class="fas fa-rupee-sign fa-3x"></i>
</div>

</div>

</div>

</div>

</div>


</div>

{{-- QUICK ACTIONS --}}

<div class="card card-outline card-primary">


<div class="card-header">

<h3 class="card-title">
Quick Actions
</h3>

</div>

<div class="card-body">

<a href="{{ route('patients.create') }}"
class="btn btn-primary m-1">

<i class="fas fa-user-plus"></i>
New Patient

</a>

<a href="{{ route('appointments.create') }}"
class="btn btn-success m-1">

<i class="fas fa-calendar-plus"></i>
Appointment

</a>

</div>


</div>

<div class="row">


{{-- RECENT PATIENTS --}}
<div class="col-md-6">

<div class="card card-outline card-primary">

<div class="card-header">
<h3 class="card-title">
Recent Patients
</h3>
</div>

<div class="card-body">

<table class="table table-bordered table-sm">

<thead>

<tr>
<th>UHID</th>
<th>Name</th>
</tr>

</thead>

<tbody>

@foreach($recentPatients ?? [] as $patient)

<tr>
<td>{{ $patient->uhid }}</td>
<td>{{ $patient->patient_name }}</td>
</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>


{{-- RECENT APPOINTMENTS --}}
<div class="col-md-6">

<div class="card card-outline card-success">

<div class="card-header">
<h3 class="card-title">
Recent Appointments
</h3>
</div>

<div class="card-body">

<table class="table table-bordered table-sm">

<thead>

<tr>
<th>Patient</th>
<th>Date</th>
</tr>

</thead>

<tbody>

@foreach($recentAppointments ?? [] as $appointment)

<tr>
<td>{{ $appointment->patient->patient_name ?? '' }}</td>
<td>{{ $appointment->appointment_date }}</td>
</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>


</div>


<div class="card card-outline card-info">
<div class="card-header">
<h3 class="card-title">Hospital Overview</h3>
</div>

<div class="card-body">
<div id="hospitalChart"></div>
</div>
</div>



@stop


@section('js')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
var options = {
    chart: {
        type: 'bar',
        height: 400,
        toolbar: {
            show: false
        }
    },
    series: [{
        name: 'Count',
        data: [
            {{ $patients }},
            {{ $appointments }},
            {{ $doctors }},
            {{ $revenue }}
        ]
    }],
    xaxis: {
        categories: [
            'Patients',
            'Appointments',
            'Doctors',
            'Revenue'
        ]
    },
    dataLabels: {
        enabled: true
    }
};

var chart = new ApexCharts(
    document.querySelector("#hospitalChart"),
    options
);

chart.render();
</script>



@stop
