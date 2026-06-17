<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\PharmacyBill;

class DashboardController extends Controller
{
    public function index()
    {
        $patients = Patient::count();
        $appointments = Appointment::count();
        $doctors = Doctor::count();
        $revenue = PharmacyBill::sum('net_amount');

        return view('dashboard', compact(
            'patients',
            'appointments',
            'doctors',
            'revenue'
        ));
    }
}