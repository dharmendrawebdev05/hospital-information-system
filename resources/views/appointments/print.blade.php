<!DOCTYPE html>
<html>
<head>
    <title>Appointment Slip</title>
    <style>
        body {
            font-family: Arial;
        }
        .slip {
            width: 100%;
            border: 2px solid #000;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #000;
            margin-bottom: 15px;
        }
        .row {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
        .token {
            font-size: 22px;
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

<div class="slip">

    <div class="header">
        <h2>🏥 Hospital OPD Appointment Slip</h2>
        <p>Hospital OS Core</p>
    </div>

    <div class="row">
        <span class="label">Token No:</span>
        <span class="token">{{ $appointment->token_no }}</span>
    </div>

    <div class="row">
        <span class="label">Patient Name:</span>
        {{ $appointment->patient->patient_name }}
    </div>

    <div class="row">
        <span class="label">Doctor Name:</span>
        {{ $appointment->doctor->doctor_name }}
    </div>

    <div class="row">
        <span class="label">Date:</span>
        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
    </div>

    <div class="row">
        <span class="label">Time:</span>
        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
    </div>

    <div class="row">
        <span class="label">Consultation Fee:</span>
        ₹ {{ $appointment->consultation_fee }}
    </div>

    <hr>

    <p style="text-align:center;">
        Please arrive 15 minutes before your appointment time.
    </p>

</div>
<script>
    window.onload = function () {
        window.print();
    };
</script>

</body>
</html>