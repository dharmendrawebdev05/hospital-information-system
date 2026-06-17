@extends('adminlte::page')

@section('title','OPD Visit Details')

@section('content')

<div class="container-fluid mt-3">

{{-- HEADER --}}
<div class="card card-primary card-outline">
<div class="card-header d-flex justify-content-between">
<h3 class="card-title">
<i class="fas fa-hospital-user"></i> OPD Visit Summary
</h3>

<div>
<span class="badge badge-info p-2">
{{ $visit->status }}
</span>
</div>
</div>
</div>

{{-- PATIENT + DOCTOR + VISIT --}}
<div class="row">

{{-- PATIENT --}}
<div class="col-md-4">
<div class="card card-outline card-info">
<div class="card-header"><b>Patient Info</b></div>
<div class="card-body">
<p><strong>Name:</strong> {{ $visit->patient->patient_name }}</p>
<p><strong>UHID:</strong> {{ $visit->patient->uhid ?? '-' }}</p>
<p><strong>Gender:</strong> {{ $visit->patient->gender ?? '-' }}</p>
<p><strong>Age:</strong> {{ $visit->patient->age ?? '-' }}</p>
<p><strong>Mobile:</strong> {{ $visit->patient->mobile ?? '-' }}</p>
</div>
</div>
</div>

{{-- DOCTOR --}}
<div class="col-md-4">
<div class="card card-outline card-success">
<div class="card-header"><b>Doctor Info</b></div>
<div class="card-body">
<p><strong>Doctor:</strong> {{ $visit->doctor->doctor_name }}</p>
<p><strong>Department:</strong> {{ $visit->doctor->department->name ?? '-' }}</p>
</div>
</div>
</div>

{{-- VISIT --}}
<div class="col-md-4">
<div class="card card-outline card-warning">
<div class="card-header"><b>Visit Info</b></div>
<div class="card-body">
<p><strong>Visit No:</strong> {{ $visit->visit_no }}</p>
<p><strong>Date:</strong> {{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}</p>
</div>
</div>
</div>

</div>

{{-- CONSULTATION --}}
@if($visit->consultation)

<div class="card card-primary card-outline mt-3">
<div class="card-header"><b>Consultation</b></div>
<div class="card-body">

<p><strong>Chief Complaint:</strong><br>{{ $visit->consultation->chief_complaint }}</p>
<hr>

<p><strong>History:</strong><br>{{ $visit->consultation->history }}</p>
<hr>

<p><strong>Diagnosis:</strong><br>
<span class="badge badge-danger p-2">
{{ $visit->consultation->diagnosis }}
</span>
</p>
<hr>

<p><strong>Advice:</strong><br>{{ $visit->consultation->advice }}</p>

</div>
</div>

@endif

{{-- PRESCRIPTION --}}
@if($visit->consultation && $visit->consultation->prescriptions->count())

<div class="card card-success card-outline mt-3">
<div class="card-header"><b>Prescription</b></div>

<div class="card-body table-responsive">
<table class="table table-bordered table-hover">
<thead class="thead-light">
<tr>
<th>Medicine</th>
<th>Dosage</th>
<th>Frequency</th>
<th>Days</th>
</tr>
</thead>

<tbody>
@foreach($visit->consultation->prescriptions as $item)
<tr>
<td>{{ $item->medicine->medicine_name }}</td>
<td>{{ $item->dosage }}</td>
<td>{{ $item->frequency }}</td>
<td>{{ $item->duration }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>

@endif

{{-- LAB ORDERS --}}
@if($visit->consultation && $visit->consultation->labOrders->count())

<div class="card card-warning card-outline mt-3">
<div class="card-header"><b>Lab Orders</b></div>

<div class="card-body table-responsive">

<table class="table table-bordered">
<thead>
<tr>
<th>Test</th>
<th>Instruction</th>
<th>Status</th>
</tr>
</thead>

<tbody>
@foreach($visit->consultation->labOrders as $order)
<tr>
<td>{{ $order->labTest->test_name ?? '-' }}</td>
<td>{{ $order->instruction ?? '-' }}</td>
<td>
<span class="badge badge-{{ $order->status == 'Pending' ? 'warning' : 'success' }}">
{{ $order->status }}
</span>
</td>
</tr>
@endforeach
</tbody>
</table>

</div>
</div>

@endif

{{-- RADIOLOGY --}}
@if($visit->consultation && $visit->consultation->radiologyOrders->count())

<div class="card card-danger card-outline mt-3">
<div class="card-header"><b>Radiology</b></div>

<div class="card-body table-responsive">

<table class="table table-bordered">
<thead>
<tr>
<th>Test</th>
<th>Instruction</th>
<th>Status</th>
</tr>
</thead>

<tbody>
@foreach($visit->consultation->radiologyOrders as $order)
<tr>
<td>{{ $order->radiologyTest->test_name ?? '-' }}</td>
<td>{{ $order->instruction ?? '-' }}</td>
<td>
<span class="badge badge-{{ $order->status == 'Pending' ? 'warning' : 'success' }}">
{{ $order->status }}
</span>
</td>
</tr>
@endforeach
</tbody>
</table>

</div>
</div>

@endif

{{-- PROCEDURES --}}
@if($visit->consultation && $visit->consultation->procedureOrders->count())

<div class="card card-secondary card-outline mt-3">
<div class="card-header"><b>Procedures</b></div>

<div class="card-body table-responsive">

<table class="table table-bordered">
<thead>
<tr>
<th>Procedure</th>
<th>Remarks</th>
<th>Status</th>
</tr>
</thead>

<tbody>
@foreach($visit->consultation->procedureOrders as $order)
<tr>
<td>{{ $order->procedure->procedure_name ?? '-' }}</td>
<td>{{ $order->remarks ?? '-' }}</td>
<td>
<span class="badge badge-{{ $order->status == 'Pending' ? 'warning' : 'success' }}">
{{ $order->status }}
</span>
</td>
</tr>
@endforeach
</tbody>
</table>

</div>
</div>

@endif

{{-- ACTION BUTTONS --}}
<div class="card mt-3 no-print">
<div class="card-footer text-right">

<a href="{{ route('opd.print', $visit->id) }}"
target="_blank"
class="btn btn-primary">
<i class="fas fa-print"></i> Full OPD Print
</a>

<a href="{{ route('opd.prescription.print', $visit->id) }}"
target="_blank"
class="btn btn-success">
<i class="fas fa-pills"></i> Prescription
</a>

<a href="{{ route('opd.lab.print', $visit->id) }}"
target="_blank"
class="btn btn-warning">
<i class="fas fa-flask"></i> Lab Slip
</a>

<a href="{{ route('opd.radiology.print', $visit->id) }}"
target="_blank"
class="btn btn-danger">
<i class="fas fa-x-ray"></i> Radiology
</a>

<a href="{{ route('opd.procedure.print', $visit->id) }}"
target="_blank"
class="btn btn-secondary">
<i class="fas fa-procedures"></i> Procedures
</a>

@if($visit->status == 'Completed')
<a href="{{ route('ipd.admissions.create', $visit->id) }}"
class="btn btn-dark">
<i class="fas fa-bed"></i> Admit To IPD
</a>
@endif

</div>
</div>


</div>

@stop