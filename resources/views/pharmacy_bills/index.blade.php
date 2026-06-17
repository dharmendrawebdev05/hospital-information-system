@extends('adminlte::page')

@section('title', 'Pharmacy Bills')

@section('content')

<div class="card mt-3  card-outline card-primary">

    <div class="card-header">

        <h3 class="card-title">
            Pharmacy Bills
        </h3>

        <div class="card-tools">

            <a href="{{ route('pharmacy.queue') }}"
               class="btn btn-primary btn-sm">

                OPD Queue

            </a>

        </div>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>Bill No</th>

                    <th>Patient</th>

                    <th>Date</th>

                    <th>Total</th>

                    <th>Paid</th>

                    <th>Status</th>

                    <th width="200">Action</th>

                </tr>

            </thead>

            <tbody>

            @forelse($bills as $bill)

                <tr>

                    <td>{{ $bill->bill_no }}</td>

                    <td>{{ $bill->patient->patient_name ?? '' }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($bill->bill_date)->format('d M Y') }}
                    </td>

                    <td>₹ {{ number_format($bill->total_amount,2) }}</td>

                    <td>₹ {{ number_format($bill->paid_amount,2) }}</td>

                    <td>

                        @if($bill->status == 'Pending')

                            <span class="badge badge-warning">Pending</span>

                        @elseif($bill->status == 'Paid')

                            <span class="badge badge-primary">Paid</span>

                        @elseif($bill->status == 'Dispensed')

                            <span class="badge badge-success">Dispensed</span>

                        @else

                            <span class="badge badge-danger">Cancelled</span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('pharmacy-bills.show', $bill->id) }}"
                           class="btn btn-info btn-sm">

                            View

                        </a>

                        <a href="{{ route('pharmacy.print', $bill->id) }}"
                           target="_blank"
                           class="btn btn-primary btn-sm">

                            Print

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7"
                        class="text-center text-danger">

                        No Pharmacy Bills Found

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop