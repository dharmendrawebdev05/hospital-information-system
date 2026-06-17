<!DOCTYPE html>
<html>

<head>

    <title>Pharmacy Bill</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            font-size:14px;
        }

        .text-center{
            text-align:center;
        }

        .table{
            width:100%;
            border-collapse: collapse;
            margin-top:15px;
        }

        .table th,
        .table td{
            border:1px solid #000;
            padding:8px;
        }

        .table th{
            background:#f2f2f2;
        }

        .right{
            text-align:right;
        }

        .mt-20{
            margin-top:20px;
        }

    </style>

</head>

<body onload="window.print()">

    {{-- Hospital Header --}}

    <div class="text-center">

        <h2>YOUR HOSPITAL NAME</h2>

        <p>
            Address Line 1<br>
            Mobile: +91XXXXXXXXXX
        </p>

        <h3>PHARMACY BILL</h3>

    </div>

    <hr>

    {{-- Bill Information --}}

    <table width="100%">

        <tr>

            <td>

                <strong>Bill No:</strong>
                {{ $bill->bill_no }}

            </td>

            <td class="right">

                <strong>Date:</strong>
                {{ \Carbon\Carbon::parse($bill->bill_date)->format('d M Y') }}

            </td>

        </tr>

        <tr>

            <td>

                <strong>Patient:</strong>
                {{ $bill->patient->patient_name ?? '' }}

            </td>

            <td class="right">

                <strong>Visit No:</strong>
                {{ $bill->opdVisit->visit_no ?? '' }}

            </td>

        </tr>

    </table>

    {{-- Medicines --}}

    <table class="table">

        <thead>

            <tr>

                <th>#</th>

                <th>Medicine</th>

                <th>Qty</th>

                <th>Rate</th>

                <th>Amount</th>

            </tr>

        </thead>

        <tbody>

        @foreach($bill->items as $item)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->medicine->medicine_name ?? '' }}
                </td>

                <td>
                    {{ $item->qty }}
                </td>

                <td>
                    ₹ {{ number_format($item->rate,2) }}
                </td>

                <td>
                    ₹ {{ number_format($item->amount,2) }}
                </td>

            </tr>

        @endforeach

        </tbody>

        <tfoot>

            <tr>

                <th colspan="4"
                    class="right">

                    Total

                </th>

                <th>

                    ₹ {{ number_format($bill->total_amount,2) }}

                </th>

            </tr>

        </tfoot>

    </table>

    {{-- Payment Info --}}

    <table width="100%" class="mt-20">

        <tr>

            <td>

                <strong>Paid Amount:</strong>

                ₹ {{ number_format($bill->paid_amount,2) }}

            </td>

            <td class="right">

                <strong>Status:</strong>

                {{ $bill->status }}

            </td>

        </tr>

    </table>

    <br><br><br>

    <table width="100%">

        <tr>

            <td>
                ___________________<br>
                Pharmacist Signature
            </td>

            <td class="right">
                ___________________<br>
                Patient Signature
            </td>

        </tr>

    </table>

</body>

</html>