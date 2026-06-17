@extends('adminlte::page')

@section('title','Doctor Profile')

@section('content')

<div class="container-fluid mt-3">

{{-- HEADER CARD --}}
<div class="card card-primary card-outline">

<div class="card-body">

<div class="row">

<div class="col-md-8">

<h3>{{ $doctor->doctor_name }}</h3>

<p>
<span class="badge badge-primary">
{{ $doctor->doctor_code }}
</span>

<span class="badge badge-success">
{{ $doctor->department->name }}
</span>
</p>

<p class="text-muted">
{{ $doctor->specialization }}
</p>

</div>

<div class="col-md-4 text-right">

<a href="{{ route('doctors.edit',$doctor->id) }}"
class="btn btn-warning">
Edit
</a>

</div>

</div>

</div>

</div>

{{-- STATS --}}
<div class="row">

<div class="col-md-3">
<div class="small-box bg-info">
<div class="inner">
<h4>{{ $doctor->mobile }}</h4>
<p>Mobile</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-success">
<div class="inner">
<h4>{{ $doctor->consultation_fee }}</h4>
<p>Consult Fee</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-warning">
<div class="inner">
<h4>{{ $doctor->followup_fee }}</h4>
<p>Followup Fee</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-danger">
<div class="inner">
<h4>{{ $doctor->status ? 'Active' : 'Inactive' }}</h4>
<p>Status</p>
</div>
</div>
</div>

</div>

{{-- DETAILS --}}
<div class="card card-outline card-info mt-3">

<div class="card-header">
Doctor Details
</div>

<div class="card-body">

<p><b>Qualification:</b> {{ $doctor->qualification }}</p>
<p><b>Registration No:</b> {{ $doctor->registration_no }}</p>
<p><b>Email:</b> {{ $doctor->email }}</p>

</div>

</div>

</div>

@stop