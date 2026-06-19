@extends('adminlte::page')

@section('title', 'OPD Consultation')

@section('content')

<div class="container-fluid mt-3">

{{-- Validation Errors --}}
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>

<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

</div>
@endif

{{-- Success Message --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>
{{ session('success') }}
</div>
@endif

<form method="POST"
action="{{ route('consultations.store', $visit->id) }}">

@csrf

<div class="row">

{{-- ================= PATIENT INFO ================= --}}
<div class="col-md-4">

<div class="card card-primary card-outline">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-user-injured"></i>
Patient Information
</h3>
</div>

<div class="card-body">

<table class="table table-sm">

<tr>
<th width="40%">Patient</th>
<td>{{ $visit->patient->patient_name }}</td>
</tr>

<tr>
<th>UHID</th>
<td>{{ $visit->patient->uhid ?? '-' }}</td>
</tr>

<tr>
<th>Gender</th>
<td>{{ $visit->patient->gender ?? '-' }}</td>
</tr>

<tr>
<th>Age</th>
<td>{{ $visit->patient->age ?? '-' }}</td>
</tr>

<tr>
<th>Mobile</th>
<td>{{ $visit->patient->mobile ?? '-' }}</td>
</tr>

<tr>
<th>Doctor</th>
<td>{{ $visit->doctor->doctor_name }}</td>
</tr>

<tr>
<th>Visit No</th>
<td>{{ $visit->visit_no }}</td>
</tr>

<tr>
<th>Date</th>
<td>
{{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}
</td>
</tr>

</table>

</div>

</div>

</div>

{{-- ================= CONSULTATION ================= --}}
<div class="col-md-8">

<div class="card card-info card-outline">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-stethoscope"></i>
OPD Consultation
</h3>
</div>

<div class="card-body">

{{-- Chief Complaint --}}
<div class="form-group">

<label>
Chief Complaint
</label>

<textarea
name="chief_complaint"
rows="3"
class="form-control"
placeholder="Enter Chief Complaint">{{ old('chief_complaint') }}</textarea>

</div>

{{-- History --}}
<div class="form-group">

<label>
History
</label>

<textarea
name="history"
rows="4"
class="form-control"
placeholder="Enter Patient History">{{ old('history') }}</textarea>

</div>

</div>

</div>

</div>

</div>

{{-- ================= VITALS ================= --}}
<div class="card card-success card-outline">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-heartbeat"></i>
Vitals
</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-2">

<label>BP</label>

<input type="number"
name="bp"
value="{{ old('bp') }}"
step="0.1"
min="90"
max="120"
required
class="form-control @error('bp') is-invalid @enderror">

@error('bp')
<div class="invalid-feedback">
{{ $message }}
</div>
@enderror

</div>



<div class="col-md-2">

<label>Temp</label>

<input type="number"
name="temperature"
value="{{ old('temperature') }}"
step="0.1"
min="90"
max="120"
required
class="form-control @error('temperature') is-invalid @enderror">

@error('temperature')
<div class="invalid-feedback">
{{ $message }}
</div>
@enderror



</div>





<div class="col-md-2">

<label>Pulse</label>

<input type="number"
name="pulse"
value="{{ old('pulse') }}"
step="0.1"
min="90"
max="120"
required
class="form-control @error('pulse') is-invalid @enderror">

@error('pulse')
<div class="invalid-feedback">
{{ $message }}
</div>
@enderror

</div>

<div class="col-md-2">

<label>Weight</label>

<input type="number"
name="weight"
value="{{ old('temp') }}"
step="0.1"
min="90"
max="120"
required
class="form-control @error('weight') is-invalid @enderror">

@error('weight')
<div class="invalid-feedback">
{{ $message }}
</div>
@enderror



</div>

<div class="col-md-2">

<label>Height</label>

<input type="number"
name="height"
value="{{ old('temp') }}"
step="0.1"
min="90"
max="120"
required
class="form-control @error('height') is-invalid @enderror">

@error('height')
<div class="invalid-feedback">
{{ $message }}
</div>
@enderror

</div>

<div class="col-md-2">

<label>SpO₂</label>

<input type="number"
name="spo2"
value="{{ old('spo2') }}"
step="0.1"
min="90"
max="120"
required
class="form-control @error('spo2') is-invalid @enderror">

@error('spo2')
<div class="invalid-feedback">
{{ $message }}
</div>
@enderror

</div>

</div>

</div>

</div>

{{-- ================= CLINICAL EXAMINATION ================= --}}
<div class="card card-warning card-outline">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-notes-medical"></i>
Clinical Examination
</h3>

</div>

<div class="card-body">

<textarea
name="clinical_examination"
rows="4"
class="form-control"
placeholder="Clinical Examination">{{ old('clinical_examination') }}</textarea>

</div>

</div>

{{-- ================= DIAGNOSIS ================= --}}
<div class="card card-danger card-outline">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-diagnoses"></i>
Diagnosis
</h3>

</div>

<div class="card-body">

<textarea
name="diagnosis"
rows="4"
class="form-control"
placeholder="Diagnosis">{{ old('diagnosis') }}</textarea>

</div>

</div>



{{-- ================= PRESCRIPTION ================= --}}
<div class="card card-success card-outline mt-3">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-pills"></i>
Prescription
</h3>
</div>

<div class="card-body">

<table class="table table-bordered" id="prescriptionTable">

<thead class="thead-light">
<tr>
<th style="width: 25%">Medicine</th>
<th>Dosage</th>
<th>Frequency</th>
<th>Days</th>
<th>Instruction</th>
<th style="width: 80px">Action</th>
</tr>
</thead>

<tbody>

{{-- FIRST ROW --}}
<tr>

{{-- MEDICINE --}}
<td>
<select name="medicine_id[]" class="form-control select2">
<option value="">Select Medicine</option>
@foreach($medicines as $medicine)
<option value="{{ $medicine->id }}">
{{ $medicine->medicine_name }}
</option>
@endforeach
</select>
</td>

{{-- DOSAGE --}}
<td>
<input type="text"
name="dosage[]"
class="form-control"
placeholder="e.g. 1-0-1">
</td>

{{-- FREQUENCY --}}
<td>
<select name="frequency[]" class="form-control">
<option value="">Select</option>
<option>OD</option>
<option>BD</option>
<option>TDS</option>
<option>QID</option>
<option>HS</option>
<option>SOS</option>
</select>
</td>

{{-- DAYS --}}
<td>
<input type="number"
name="days[]"
class="form-control"
min="1"
placeholder="Days">
</td>

{{-- INSTRUCTION --}}
<td>
<input type="text"
name="instruction[]"
class="form-control"
placeholder="After Food / Before Food">
</td>

{{-- ACTION --}}
<td class="text-center">
<button type="button" class="btn btn-danger btn-sm removeRow">
<i class="fas fa-trash"></i>
</button>
</td>

</tr>

</tbody>

</table>

{{-- ADD BUTTON --}}
<button type="button" id="addRow" class="btn btn-primary btn-sm">
<i class="fas fa-plus"></i> Add Medicine
</button>

</div>

</div>

{{-- ================= PROCEDURE ================= --}}
<div class="card card-warning card-outline mt-3">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-procedures"></i>
Procedures
</h3>
</div>

<div class="card-body">

<table class="table table-bordered" id="procedureTable">

<thead class="thead-light">
<tr>
<th style="width: 40%">Procedure</th>
<th>Remarks</th>
<th style="width: 80px">Action</th>
</tr>
</thead>

<tbody>

{{-- FIRST ROW --}}
<tr>

{{-- PROCEDURE --}}
<td>
<select name="procedure_id[]" class="form-control select2">
<option value="">Select Procedure</option>
@foreach($procedures as $procedure)
<option value="{{ $procedure->id }}">
{{ $procedure->procedure_name }}
</option>
@endforeach
</select>
</td>

{{-- REMARKS --}}
<td>
<input type="text"
name="procedure_remarks[]"
class="form-control"
placeholder="Remarks (optional)">
</td>

{{-- ACTION --}}
<td class="text-center">
<button type="button" class="btn btn-danger btn-sm removeProcedureRow">
<i class="fas fa-trash"></i>
</button>
</td>

</tr>

</tbody>

</table>

{{-- ADD BUTTON --}}
<button type="button" id="addProcedureRow" class="btn btn-primary btn-sm">
<i class="fas fa-plus"></i> Add Procedure
</button>

</div>

</div>


<div class="card card-primary card-outline mt-3">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-flask"></i>
Lab Tests
</h3>
</div>

<div class="card-body">

<table class="table table-bordered" id="labTable">

<thead class="thead-light">
<tr>
<th style="width: 40%">Test</th>
<th>Instruction</th>
<th style="width: 20%">Priority</th>
<th style="width: 80px">Action</th>
</tr>
</thead>

<tbody>

<tr>

<td>
<select name="lab_test_id[]" class="form-control select2">
<option value="">Select Test</option>
@foreach($labTests as $test)
<option value="{{ $test->id }}">
{{ $test->test_name }}
</option>
@endforeach
</select>
</td>

<td>
<input type="text"
name="lab_instruction[]"
class="form-control"
placeholder="Instruction (Fasting etc.)">
</td>

<td>
<select name="lab_priority[]" class="form-control">
<option value="Routine">Routine</option>
<option value="Urgent">Urgent</option>
</select>
</td>

<td class="text-center">
<button type="button" class="btn btn-danger btn-sm removeLabRow">
<i class="fas fa-trash"></i>
</button>
</td>

</tr>

</tbody>

</table>

<button type="button" id="addLabRow" class="btn btn-primary btn-sm">
<i class="fas fa-plus"></i> Add Lab Test
</button>

</div>

</div>


<div class="card card-danger card-outline mt-3">

<div class="card-header">
<h3 class="card-title">
<i class="fas fa-x-ray"></i>
Radiology
</h3>
</div>

<div class="card-body">

<table class="table table-bordered" id="radiologyTable">

<thead class="thead-light">
<tr>
<th style="width: 40%">Test</th>
<th>Instruction</th>
<th style="width: 20%">Priority</th>
<th style="width: 80px">Action</th>
</tr>
</thead>

<tbody>

<tr>

<td>
<select name="radiology_test_id[]" class="form-control select2">
<option value="">Select Test</option>
@foreach($radiologyTests as $test)
<option value="{{ $test->id }}">
{{ $test->test_name }}
</option>
@endforeach
</select>
</td>

<td>
<input type="text"
name="radiology_instruction[]"
class="form-control"
placeholder="Instruction">
</td>

<td>
<select name="radiology_priority[]" class="form-control">
<option value="Routine">Routine</option>
<option value="Urgent">Urgent</option>
</select>
</td>

<td class="text-center">
<button type="button" class="btn btn-danger btn-sm removeRadiologyRow">
<i class="fas fa-trash"></i>
</button>
</td>

</tr>

</tbody>

</table>

<button type="button" id="addRadiologyRow" class="btn btn-primary btn-sm">
<i class="fas fa-plus"></i> Add Radiology Test
</button>

</div>

</div>





{{-- ================= ADVICE ================= --}}
<div class="card card-primary card-outline">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-comment-medical"></i>
Advice
</h3>

</div>

<div class="card-body">

<textarea
name="advice"
rows="4"
class="form-control"
placeholder="Doctor Advice">{{ old('advice') }}</textarea>

</div>

</div>

{{-- ================= FOLLOWUP ================= --}}
<div class="card card-secondary card-outline">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-calendar-check"></i>
Follow-Up
</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<label>Follow-Up Date</label>

<input type="date"
name="followup_date"
value="{{ old('followup_date') }}"
class="form-control">

</div>

<div class="col-md-6">

<label>Visit Status</label>

<select name="visit_status"
class="form-control select2">

<option value="Completed">
Completed
</option>

<option value="Followup">
Follow-up
</option>

</select>

</div>

</div>

</div>

</div>

{{-- ================= BUTTONS ================= --}}
<div class="card">

<div class="card-footer text-right">

<a href="{{ url()->previous() }}"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>
Back

</a>

<button type="submit"
class="btn btn-success">

<i class="fas fa-save"></i>
Save Consultation

</button>

</div>

</div>

</form>

</div>

@stop

@section('js')
<script>
$(document).ready(function () {

$('.select2').select2();


// ================= PRESCRIPTION =================
$('#addRow').click(function () {
let row = $('#prescriptionTable tbody tr:first').clone();
row.find('input, select').val('');
$('#prescriptionTable tbody').append(row);

});

$(document).on('click', '.removeRow', function () {
if ($('#prescriptionTable tbody tr').length > 1) {
$(this).closest('tr').remove();
}
});

// ================= PROCEDURE =================
$('#addProcedureRow').click(function () {
let row = $('#procedureTable tbody tr:first').clone();
row.find('input, select').val('');
$('#procedureTable tbody').append(row);

});

$(document).on('click', '.removeProcedureRow', function () {
if ($('#procedureTable tbody tr').length > 1) {
$(this).closest('tr').remove();
}
});

// ================= LAB =================
$('#addLabRow').click(function () {
let row = $('#labTable tbody tr:first').clone();
row.find('input, select').val('');
$('#labTable tbody').append(row);

});

$(document).on('click', '.removeLabRow', function () {
if ($('#labTable tbody tr').length > 1) {
$(this).closest('tr').remove();
}
});

// ================= RADIOLOGY =================
$('#addRadiologyRow').click(function () {
let row = $('#radiologyTable tbody tr:first').clone();
row.find('input, select').val('');
$('#radiologyTable tbody').append(row);

});

$(document).on('click', '.removeRadiologyRow', function () {
if ($('#radiologyTable tbody tr').length > 1) {
$(this).closest('tr').remove();
}
});

});
</script>
@stop