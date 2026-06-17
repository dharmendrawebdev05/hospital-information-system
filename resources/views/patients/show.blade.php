@extends('adminlte::page')

@section('title','Patient Profile')

@section('content')

<div class="container-fluid">

<!-- Patient Profile Header -->

<div class="card card-primary card-outline shadow-sm mt-3">

<div class="card-body">

<div class="row align-items-center">

<div class="col-md-8">

<div class="d-flex align-items-center">

<div class="mr-3">

<div style="
width:70px;
height:70px;
border-radius:50%;
background:#007bff;
color:white;
font-size:28px;
display:flex;
align-items:center;
justify-content:center;
font-weight:bold;
">
{{ strtoupper(substr($patient->patient_name,0,1)) }}
</div>

</div>

<div>

<h3 class="mb-1">
{{ $patient->patient_name }}
</h3>

<span class="badge badge-primary">
UHID : {{ $patient->uhid }}
</span>

<br>

<small class="text-muted">

{{ $patient->gender }}
|
{{ $patient->age }} Years

@if($patient->blood_group)
|
Blood Group :
{{ $patient->blood_group }}
@endif

</small>

</div>

</div>

</div>

<div class="col-md-4 text-right">

<a href="{{ route('patients.edit',$patient->id) }}"
class="btn btn-warning">

<i class="fas fa-edit"></i>
Edit

</a>

<a href="#"
onclick="window.print()"
class="btn btn-primary">

<i class="fas fa-print"></i>
Print

</a>

</div>

</div>

</div>

</div>

<!-- Quick Info -->

<div class="row">

<div class="col-md-3">

<div class="small-box bg-info">

<div class="inner">
<h4>{{ $patient->mobile }}</h4>
<p>Mobile Number</p>
</div>

<div class="icon">
<i class="fas fa-phone"></i>
</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-success">

<div class="inner">
<h4>{{ $patient->patient_type ?? 'General' }}</h4>
<p>Patient Type</p>
</div>

<div class="icon">
<i class="fas fa-user-tag"></i>
</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-warning">

<div class="inner">
<h4>{{ $patient->blood_group ?? '-' }}</h4>
<p>Blood Group</p>
</div>

<div class="icon">
<i class="fas fa-tint"></i>
</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-danger">

<div class="inner">
<h4>{{ $patient->marital_status ?? '-' }}</h4>
<p>Marital Status</p>
</div>

<div class="icon">
<i class="fas fa-heart"></i>
</div>

</div>

</div>

</div>

<!-- Details -->

<div class="row">

<!-- Personal Details -->

<div class="col-md-6">

<div class="card card-outline card-primary">

<div class="card-header">
<h5 class="mb-0">
<i class="fas fa-user"></i>
Personal Information
</h5>
</div>

<div class="card-body p-0">

<table class="table table-striped mb-0">

<tr>
<th width="35%">UHID</th>
<td>{{ $patient->uhid }}</td>
</tr>

<tr>
<th>Name</th>
<td>{{ $patient->patient_name }}</td>
</tr>

<tr>
<th>Gender</th>
<td>{{ $patient->gender }}</td>
</tr>

<tr>
<th>Age</th>
<td>{{ $patient->age }}</td>
</tr>

<tr>
<th>DOB</th>
<td>{{ $patient->dob }}</td>
</tr>

<tr>
<th>Blood Group</th>
<td>{{ $patient->blood_group }}</td>
</tr>

<tr>
<th>Occupation</th>
<td>{{ $patient->occupation }}</td>
</tr>

</table>

</div>

</div>

</div>

<!-- Contact Details -->

<div class="col-md-6">

<div class="card card-outline card-success">

<div class="card-header">

<h5 class="mb-0">
<i class="fas fa-address-book"></i>
Contact Information
</h5>

</div>

<div class="card-body p-0">

<table class="table table-striped mb-0">

<tr>
<th width="35%">Mobile</th>
<td>{{ $patient->mobile }}</td>
</tr>

<tr>
<th>Emergency Contact</th>
<td>{{ $patient->emergency_contact }}</td>
</tr>

<tr>
<th>Email</th>
<td>{{ $patient->email }}</td>
</tr>

<tr>
<th>Aadhaar No</th>
<td>{{ $patient->aadhaar_no }}</td>
</tr>

<tr>
<th>Patient Type</th>
<td>{{ $patient->patient_type }}</td>
</tr>

<tr>
<th>Marital Status</th>
<td>{{ $patient->marital_status }}</td>
</tr>

</table>

</div>

</div>

</div>

</div>

<!-- Address -->

<div class="card card-outline card-warning">

<div class="card-header">

<h5 class="mb-0">
<i class="fas fa-map-marker-alt"></i>
Address Information
</h5>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">

<strong>City</strong>

<p class="text-muted">
{{ $patient->city ?? '-' }}
</p>

</div>

<div class="col-md-4">

<strong>State</strong>

<p class="text-muted">
{{ $patient->state ?? '-' }}
</p>

</div>

<div class="col-md-4">

<strong>Pincode</strong>

<p class="text-muted">
{{ $patient->pincode ?? '-' }}
</p>

</div>

</div>

<hr>

<strong>Full Address</strong>

<p class="mb-0">
{{ $patient->address ?? '-' }}
</p>

</div>

</div>

</div>

@stop