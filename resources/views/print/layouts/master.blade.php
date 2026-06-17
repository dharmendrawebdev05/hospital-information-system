<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Hospital Print</title>

<style>
body {
font-family: Arial, sans-serif;
font-size: 14px;
color: #000;
}

@media print {
.no-print {
display: none !important;
}
}

.header {
border-bottom: 2px solid #000;
margin-bottom: 10px;
padding-bottom: 10px;
}

.patient-box {
margin-top: 10px;
padding: 8px;
border: 1px solid #ddd;
}

.section {
margin-top: 15px;
}

table {
width: 100%;
border-collapse: collapse;
}

table, th, td {
border: 1px solid #000;
}

th, td {
padding: 6px;
text-align: left;
}

.footer {
margin-top: 50px;
display: flex;
justify-content: space-between;
}

.signature-box {
text-align: center;
width: 40%;
}

.hospital-title {
font-size: 20px;
font-weight: bold;
}

.hospital-subtitle {
font-size: 12px;
}

.right {
text-align: right;
}
</style>


</head>

<body>

@php
$patient = $visit->patient ?? null;
$doctor = $visit->doctor ?? null;
@endphp

{{-- ================= HEADER ================= --}}
<div class="header">

<table width="100%">

<tr>

{{-- LOGO --}}
<td width="15%">
<img src="{{ asset('images/hospital-logo.png') }}"
style="height:70px;">
</td>

{{-- HOSPITAL INFO --}}
<td width="70%" style="text-align:center;">
<div class="hospital-title">
🏥 City Care Hospital
</div>

<div class="hospital-subtitle">
123 Medical Street, City | Ph: 9876543210
</div>

<div class="hospital-subtitle">
Email: info@hospital.com
</div>
</td>

{{-- QR CODE --}}
<td width="15%" class="right">
@if(!empty($visit->visit_no))
<img
src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ $visit->visit_no }}"
>
@endif
</td>

</tr>

</table>

</div>

{{-- ================= PATIENT INFO ================= --}}
<div class="patient-box">

<table width="100%">

<tr>
<td><b>Patient:</b> {{ $patient->patient_name ?? '-' }}</td>
<td><b>UHID:</b> {{ $patient->uhid ?? '-' }}</td>
<td><b>Gender:</b> {{ $patient->gender ?? '-' }}</td>
</tr>

<tr>
<td><b>Age:</b> {{ $patient->age ?? '-' }}</td>
<td><b>Mobile:</b> {{ $patient->mobile ?? '-' }}</td>
<td><b>Visit No:</b> {{ $visit->visit_no ?? '-' }}</td>
</tr>

<tr>
<td><b>Doctor:</b> {{ $doctor->doctor_name ?? '-' }}</td>
<td colspan="2">
<b>Date:</b> {{ now()->format('d M Y H:i') }}
</td>
</tr>

</table>

</div>

{{-- ================= MAIN CONTENT ================= --}}
<div class="section">

@yield('content')

</div>

{{-- ================= SIGNATURE ================= --}}
<div class="footer">

<div class="signature-box">
_______________________<br>
Patient Signature
</div>

<div class="signature-box">
_______________________<br>
Doctor Signature
</div>

</div>

{{-- ================= PRINT BUTTON ================= --}}
<div class="no-print" style="text-align:center; margin-top:20px;">

<button onclick="window.print()"
style="padding:8px 20px; cursor:pointer;">
🖨 Print
</button>

</div>

</body>
</html>