@extends('adminlte::page')

@section('title', 'Doctor Dashboard')

@section('content_header')

<div class="row mb-3">

<div class="col-md-8">

<h2 class="font-weight-bold">
<i class="fas fa-user-md text-success"></i>
Doctor Dashboard
</h2>

<p class="text-muted mb-0">
Welcome Dr. {{ auth()->user()->name }}
</p>

</div>

<div class="col-md-4 text-right">

<span class="badge badge-success p-2">
{{ now()->format('d M Y') }}
</span>

</div>

</div>

@stop


@section('content')

{{-- TOP STATS --}}
<div class="row">

{{-- TODAY APPOINTMENTS --}}
<div class="col-lg-3 col-md-6">

<div class="card bg-gradient-primary elevation-3">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>
    <h2>{{ $todayAppointments ?? 0 }}</h2>
    <p class="mb-0">Today's Appointments</p>
</div>

<div>
    <i class="fas fa-calendar-day fa-3x"></i>
</div>

</div>

</div>

</div>

</div>

{{-- QUEUE --}}
<div class="col-lg-3 col-md-6">

<div class="card bg-gradient-warning elevation-3">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>
    <h2>{{ $queue ?? 0 }}</h2>
    <p class="mb-0">Waiting Queue</p>
</div>

<div>
    <i class="fas fa-users fa-3x"></i>
</div>

</div>

</div>

</div>

</div>

{{-- COMPLETED --}}
<div class="col-lg-3 col-md-6">

<div class="card bg-gradient-success elevation-3">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>
    <h2>{{ $completed ?? 0 }}</h2>
    <p class="mb-0">Completed</p>
</div>

<div>
    <i class="fas fa-check fa-3x"></i>
</div>

</div>

</div>

</div>

</div>

{{-- NEXT PATIENT --}}
<div class="col-lg-3 col-md-6">

<div class="card bg-gradient-danger elevation-3">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>
    <h4 class="mb-0">
        {{ $nextPatient->patient_name ?? 'No Patient' }}
    </h4>
    <p class="mb-0">Next Patient</p>
</div>

<div>
    <i class="fas fa-user-injured fa-3x"></i>
</div>

</div>

</div>

</div>

</div>

</div>


{{-- MAIN CONTENT --}}
<div class="row">

{{-- PATIENT QUEUE --}}
<div class="col-md-8">

<div class="card card-outline card-primary">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-list"></i> Patient Queue (Today)
</h3>
</div>

<div class="card-body p-0">

<table class="table table-bordered table-sm mb-0">

<thead class="thead-light">
    <tr>
        <th>Token</th>
        <th>Patient</th>
        <th>Time</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>

<tbody>

    @forelse($queueList ?? [] as $q)

    <tr>
        <td>{{ $q->token_no ?? '-' }}</td>
        <td>{{ $q->patient->patient_name ?? '' }}</td>
        <td>{{ $q->appointment_time ?? '' }}</td>

        <td>
            <span class="badge badge-warning">
                Waiting
            </span>
        </td>

        <td>
            <a href="{{ url('/opd/start/'.$q->id) }}"
               class="btn btn-primary btn-sm">

                <i class="fas fa-stethoscope"></i>
                Start

            </a>
        </td>

    </tr>

    @empty

    <tr>
        <td colspan="5" class="text-center text-muted">
            No patients in queue
        </td>
    </tr>

    @endforelse

</tbody>

</table>

</div>

</div>

</div>


{{-- RIGHT SIDE --}}
<div class="col-md-4">

{{-- NEXT PATIENT CARD --}}
<div class="card card-outline card-danger">

<div class="card-header">
<h3 class="card-title">Next Patient</h3>
</div>

<div class="card-body">

<h4>
{{ $nextPatient->patient_name ?? 'None' }}
</h4>

<p class="text-muted mb-2">
UHID: {{ $nextPatient->uhid ?? '-' }}
</p>

<a href="{{ url('/opd/start/'.($nextPatient->id ?? 0)) }}"
class="btn btn-success btn-block">

Start Consultation
</a>

</div>

</div>


{{-- RECENT PATIENTS --}}
<div class="card card-outline card-info mt-3">

<div class="card-header">
<h3 class="card-title">Recent Patients</h3>
</div>

<div class="card-body">

<ul class="list-group">

@forelse($recentPatients ?? [] as $p)

<li class="list-group-item">

    <i class="fas fa-user-injured text-primary"></i>
    {{ $p->patient_name }}

    <span class="float-right text-muted small">
        {{ $p->updated_at->diffForHumans() }}
    </span>

</li>

@empty

<li class="list-group-item text-muted text-center">
    No recent patients
</li>

@endforelse

</ul>

</div>

</div>

</div>

</div>

@stop


{{-- CHART --}}
@section('js')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
var options = {
chart: {
type: 'bar',
height: 250,
toolbar: { show: false }
},
series: [{
name: 'Count',
data: [
{{ $todayAppointments ?? 0 }},
{{ $queue ?? 0 }},
{{ $completed ?? 0 }}
]
}],
xaxis: {
categories: ['Appointments', 'Queue', 'Completed']
},
dataLabels: {
enabled: true
}
};

var chart = new ApexCharts(document.querySelector("#doctorChart"), options);
chart.render();
</script>

@stop