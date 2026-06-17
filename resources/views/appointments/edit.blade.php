@extends('adminlte::page')

@section('title','Edit Appointment')

@section('content')

<div class="card mt-3  card-outline card-primary">

    <div class="card-header">
        <h3>Edit Appointment</h3>
    </div>

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
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">
                    <label>Patient</label>
                    <select name="patient_id" class="form-control">
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}"
                                {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                                {{ $patient->patient_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Doctor</label>
                    <select name="doctor_id" class="form-control">
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}"
                                {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->doctor_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mt-3">
                    <label>Appointment Date</label>
                    <input type="date"
                           name="appointment_date"
                           class="form-control"
                           value="{{ $appointment->appointment_date }}">
                </div>

                <div class="col-md-6 mt-3">
                    <label>Appointment Time</label>
                    <input type="time"
                           name="appointment_time"
                           class="form-control"
                           value="{{ $appointment->appointment_time }}"
                           required>
                </div>

            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-primary">
                Update Appointment
            </button>
        </div>

    </form>

</div>

@stop