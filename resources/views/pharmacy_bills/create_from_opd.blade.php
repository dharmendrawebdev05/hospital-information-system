@extends('adminlte::page')

@section('title', 'Generate Pharmacy Bill')

@section('content')

<div class="card mt-3  card-outline card-primary">

    <div class="card-header">
        <h3 class="card-title">
            Generate Pharmacy Bill
        </h3>
    </div>

    <form method="POST"
          action="{{ route('pharmacy-bills.store') }}">

        @csrf

        <input type="hidden"
               name="opd_visit_id"
               value="{{ $visit->id }}">

        <div class="card-body">

            {{-- Patient Information --}}

            <div class="row mb-4">

                <div class="col-md-3">
                    <label>Visit No</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $visit->visit_no }}"
                           readonly>
                </div>

                <div class="col-md-3">
                    <label>Patient</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $visit->patient->patient_name }}"
                           readonly>
                </div>

                <div class="col-md-3">
                    <label>Doctor</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $visit->doctor->doctor_name }}"
                           readonly>
                </div>

                <div class="col-md-3">
                    <label>Visit Date</label>
                    <input type="text"
                           class="form-control"
                           value="{{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}"
                           readonly>
                </div>

            </div>

            {{-- Medicines --}}

            <table class="table table-bordered">

                <thead>

                <tr>

                    <th width="40%">Medicine</th>

                    <th width="15%">Qty</th>

                    <th width="15%">Rate</th>

                    <th width="15%">Amount</th>

                </tr>

                </thead>

                <tbody>

                @php
                    $total = 0;
                @endphp

                @forelse($visit->consultation->prescriptions as $item)

                    @php

                        $qty = 1;

                        $rate = $item->medicine->selling_price ?? 0;

                        $amount = $qty * $rate;

                        $total += $amount;

                    @endphp

                    <tr>

                        <td>

                            {{ $item->medicine->medicine_name ?? '' }}

                            <input type="hidden"
                                   name="medicine_id[]"
                                   value="{{ $item->medicine_id }}">

                        </td>

                        <td>

                            <input type="number"
                                   name="qty[]"
                                   value="{{ $qty }}"
                                   min="1"
                                   class="form-control">

                        </td>

                        <td>

                            <input type="number"
                                   step="0.01"
                                   name="rate[]"
                                   value="{{ $rate }}"
                                   class="form-control">

                        </td>

                        <td>

                            ₹ {{ number_format($amount,2) }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center text-danger">

                            No Medicines Found In Prescription

                        </td>

                    </tr>

                @endforelse

                </tbody>

                <tfoot>

                    <tr>

                        <th colspan="3"
                            class="text-right">

                            Estimated Total

                        </th>

                        <th>

                            ₹ {{ number_format($total,2) }}

                        </th>

                    </tr>

                </tfoot>

            </table>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-success">

                <i class="fas fa-save"></i>

                Save Bill

            </button>

            <a href="{{ route('pharmacy.queue') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

    </form>

</div>

@stop