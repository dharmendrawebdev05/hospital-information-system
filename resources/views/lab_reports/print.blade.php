<!DOCTYPE html>
<html>
<head>
    <title>Lab Report</title>
    <style>
        body { font-family: Arial; }
        .header { text-align: center; }
        .box { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>

<body>

<div class="header">
    <h2>Hospital Lab Report</h2>
    <p>Lucknow, Uttar Pradesh</p>
</div>

<div class="box">
    <p><strong>Patient:</strong> {{ $report->patient->patient_name }}</p>
    <p><strong>Doctor:</strong> {{ $report->doctor->doctor_name }}</p>
    <p><strong>Test:</strong> {{ $report->test->test_name }}</p>
</div>

<hr>

<h4>Result</h4>

<table>
    <tr>
        <th>Status</th>
        <td>{{ $report->status }}</td>
    </tr>
</table>

<br><br>

<p>Doctor Signature: ___________________</p>

</body>
</html>