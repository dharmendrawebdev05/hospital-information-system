@extends('adminlte::page')

@section('title','Lab Report')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
    <h3>Lab Report</h3>
</div>

<div class="card-body">

<p><strong>Patient:</strong> {{ $report->patient->patient_name }}</p>
<p><strong>Doctor:</strong> {{ $report->doctor->doctor_name }}</p>
<p><strong>Test:</strong> {{ $report->test->test_name }}</p>
<p><strong>Status:</strong> {{ $report->status }}</p>

<hr>


<a href="{{ url('/lab-reports/print/'.$report->id) }}"
   class="btn btn-success">
    Download PDF
</a>


</div>

</div>

@stop