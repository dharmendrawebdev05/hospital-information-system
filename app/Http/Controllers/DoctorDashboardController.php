<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\OpdVisit;

class DoctorDashboardController extends Controller
{
public function index()
{
$doctorId = Auth::id();

// 📅 Today's appointments for this doctor
$todayAppointments = Appointment::where('doctor_id', $doctorId)
->whereDate('appointment_date', today())
->count();

// ⏳ Waiting queue (arrived but not completed)
$queueList = Appointment::with('patient')
->where('doctor_id', $doctorId)
->whereDate('appointment_date', today())
->where('status', 'arrived')
->orderBy('appointment_time')
->get();

$queue = $queueList->count();

// ✅ Completed consultations today
$completed = Appointment::where('doctor_id', $doctorId)
->whereDate('appointment_date', today())
->where('status', 'completed')
->count();

// 👤 Next patient (first in queue)
$nextPatient = $queueList->first()?->patient;

// 🧾 Recent patients (last OPD visits)
$recentPatients = Patient::whereHas('appointments', function ($q) use ($doctorId) {
$q->where('doctor_id', $doctorId);
})
->latest()
->take(5)
->get();

return view('doctor-dashboard', compact(
'todayAppointments',
'queue',
'queueList',
'completed',
'nextPatient',
'recentPatients'
));
}
}