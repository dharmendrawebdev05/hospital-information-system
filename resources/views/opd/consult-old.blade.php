@extends('adminlte::page')

@section('title', 'OPD Consultation')

@section('content')

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
</div>
@endif


<div class="row mt-3">

<!-- PATIENT INFO -->
<div class="col-md-4">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Patient Info</h3>
        </div>

        <div class="card-body">
            <p><strong>Name:</strong> {{ $visit->patient->patient_name }}</p>
            <p><strong>Doctor:</strong> {{ $visit->doctor->doctor_name }}</p>
            <p><strong>Visit No:</strong> {{ $visit->visit_no }}</p>
            <p><strong>Date:</strong>
                {{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}
            </p>
        </div>
    </div>

</div>


<!-- CONSULTATION FORM -->
<div class="col-md-8">

<form method="POST" action="{{ route('consultations.store', $visit->id) }}">
@csrf

<div class="card card-info">

<div class="card-header">
    <h3 class="card-title">Consultation Form</h3>
</div>

<div class="card-body">

<!-- BASIC INFO -->
<textarea name="chief_complaint" class="form-control mb-2" placeholder="Chief Complaint"></textarea>
<textarea name="history" class="form-control mb-2" placeholder="History"></textarea>

<div class="row">
    <div class="col-md-4">
        <input type="text" name="bp" class="form-control" placeholder="BP">
    </div>
    <div class="col-md-4">
        <input type="text" name="pulse" class="form-control" placeholder="Pulse">
    </div>
    <div class="col-md-4">
        <input type="text" name="temp" class="form-control" placeholder="Temp">
    </div>
</div>

<br>

<textarea name="diagnosis" class="form-control mb-2" placeholder="Diagnosis"></textarea>
<textarea name="advice" class="form-control mb-2" placeholder="Advice"></textarea>

<hr>

<!-- ================= PRESCRIPTION ================= -->
<h4>Prescription</h4>

<table class="table table-bordered" id="prescriptionTable">

<thead>
<tr>
<th>Medicine</th>
<th>Dosage</th>
<th>Frequency</th>
<th>Days</th>
<th>Instruction</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<tr>

<td>
<select name="medicine_id[]" class="form-control">
<option value="">Select</option>
@foreach($medicines as $medicine)
<option value="{{ $medicine->id }}">
{{ $medicine->medicine_name }}
</option>
@endforeach
</select>
</td>

<td>
<input type="text" name="dosage[]" class="form-control" required>
</td>

<td>
<input type="text" name="frequency[]" class="form-control" required>
</td>

<td>
<input type="number" name="duration[]" class="form-control" required min="1" max="365">
</td>

<td>
<input type="text" name="instruction[]" class="form-control">
</td>

<td>
<button type="button" class="btn btn-danger removeRow">X</button>
</td>

</tr>

</tbody>

</table>

<button type="button" id="addRow" class="btn btn-primary btn-sm">
+ Add Medicine
</button>

<hr>

<!-- ================= LAB TEST ================= -->
<h4>Lab Tests</h4>

<table class="table table-bordered" id="labTable">

<thead>
<tr>
<th>Test</th>
<th>Instruction</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<tr>

<td>
<select name="lab_test_id[]" class="form-control">
<option value="">Select Test</option>
@foreach($labTests as $test)
<option value="{{ $test->id }}">
{{ $test->test_name }}
</option>
@endforeach
</select>
</td>

<td>
<input type="text" name="lab_instruction[]" class="form-control">
</td>

<td>
<button type="button" class="btn btn-danger removeLabRow">X</button>
</td>

</tr>

</tbody>

</table>

<button type="button" id="addLabRow" class="btn btn-primary btn-sm">
+ Add Lab Test
</button>

</div>

<div class="card-footer">
<button type="submit" class="btn btn-success">
Save Consultation
</button>
</div>

</div>

</form>

</div>

</div>


<!-- ================= JS ================= -->
<script>

// Prescription Add Row
document.getElementById('addRow').addEventListener('click', function () {

let table = document.querySelector('#prescriptionTable tbody');

let newRow = table.rows[0].cloneNode(true);

newRow.querySelectorAll('input, select').forEach(el => el.value = '');

table.appendChild(newRow);

});

// Prescription Remove Row
document.addEventListener('click', function (e) {

if (e.target.classList.contains('removeRow')) {

let row = e.target.closest('tr');

if (document.querySelectorAll('#prescriptionTable tbody tr').length > 1) {
row.remove();
}

}

});


// Lab Add Row
document.getElementById('addLabRow').addEventListener('click', function () {

let table = document.querySelector('#labTable tbody');

let newRow = table.rows[0].cloneNode(true);

newRow.querySelectorAll('input, select').forEach(el => el.value = '');

table.appendChild(newRow);

});

// Lab Remove Row
document.addEventListener('click', function (e) {

if (e.target.classList.contains('removeLabRow')) {

let row = e.target.closest('tr');

if (document.querySelectorAll('#labTable tbody tr').length > 1) {
row.remove();
}

}

});

</script>

@stop