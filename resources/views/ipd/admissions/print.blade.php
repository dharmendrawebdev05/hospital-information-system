<!DOCTYPE html>
<html>
<head>
<title>Admission Slip</title>

<style>
body{
font-family: Arial, sans-serif;
font-size:14px;
}

table{
width:100%;
border-collapse:collapse;
}

td{
padding:6px;
}

.header{
text-align:center;
margin-bottom:20px;
}

.border{
border:1px solid #000;
}

.mt-30{
margin-top:30px;
}

@media print{
.no-print{
display:none;
}
}
</style>
</head>
<body>

<div class="header">
<h2>SOFYNEX HOSPITAL</h2>
<h4>IPD ADMISSION SLIP</h4>
</div>

<table class="border">
<tr>
<td><strong>Admission No</strong></td>
<td>{{ $admission->admission_no }}</td>

<td><strong>Date</strong></td>
<td>{{ date('d-m-Y', strtotime($admission->admission_date)) }}</td>
</tr>

<tr>
<td><strong>Patient</strong></td>
<td>{{ $admission->patient->patient_name }}</td>

<td><strong>Patient ID</strong></td>
<td>{{ $admission->patient->uhid }}</td>
</tr>

<tr>
<td><strong>Doctor</strong></td>
<td>{{ $admission->doctor->doctor_name }}</td>

<td><strong>Bed</strong></td>
<td>{{ $admission->bed->bed_no }}</td>
</tr>

<tr>
<td><strong>Ward</strong></td>
<td colspan="3">
{{ $admission->bed->ward->ward_name ?? '-' }}
</td>
</tr>

<tr>
<td><strong>Reason</strong></td>
<td colspan="3">
{{ $admission->reason }}
</td>
</tr>

</table>

<div class="mt-30">

<table>
<tr>
<td style="text-align:left;">
Patient / Attendant Signature
</td>

<td style="text-align:right;">
Admission Officer
</td>
</tr>
</table>

</div>

<br>

<button onclick="window.print()" class="no-print">
Print
</button>

</body>
</html>