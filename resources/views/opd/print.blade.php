<!DOCTYPE html>
<html>
<head>
    <title>OPD Visit Print</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table, th, td{
            border:1px solid #000;
        }

        th,td{
            padding:8px;
        }

        .text-center{
            text-align:center;
        }
    </style>
</head>
<body onload="window.print()">

<h2 class="text-center">OPD Prescription</h2>

<hr>

<p>
    <strong>Patient:</strong>
    {{ $visit->patient->patient_name }}
</p>

<p>
    <strong>Doctor:</strong>
    {{ $visit->doctor->doctor_name }}
</p>

<p>
    <strong>Visit No:</strong>
    {{ $visit->visit_no }}
</p>

<p>
    <strong>Date:</strong>
    {{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}
</p>

@if($visit->consultation)

<h3>Consultation</h3>

<p>
    <strong>Chief Complaint:</strong><br>
    {{ $visit->consultation->chief_complaint }}
</p>

<p>
    <strong>History:</strong><br>
    {{ $visit->consultation->history }}
</p>

<p>
    <strong>Diagnosis:</strong><br>
    {{ $visit->consultation->diagnosis }}
</p>

<p>
    <strong>Advice:</strong><br>
    {{ $visit->consultation->advice }}
</p>

<h3>Prescription</h3>

<table>
    <thead>
        <tr>
            <th>Medicine</th>
            <th>Dosage</th>
            <th>Frequency</th>
            <th>Days</th>
            <th>Instructions</th>
        </tr>
    </thead>

    <tbody>

    @forelse($visit->consultation->prescriptions as $item)

        <tr>
            <td>{{ $item->medicine->medicine_name ?? '' }}</td>
            <td>{{ $item->dosage }}</td>
            <td>{{ $item->frequency }}</td>
            <td>{{ $item->duration }}</td>
            <td>{{ $item->instructions }}</td>
        </tr>

    @empty

        <tr>
            <td colspan="5" class="text-center">
                No Prescription Found
            </td>
        </tr>

    @endforelse

    </tbody>
</table>

@endif

<br><br><br>

<div style="text-align:right;">
    ______________________
    <br>
    Doctor Signature
</div>

</body>
</html>