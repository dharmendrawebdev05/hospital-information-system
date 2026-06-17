<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Carbon\Carbon;
use App\Models\DoctorSchedule;
use App\Models\DoctorScheduleSession;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{

public function index(Request $request)
{
if ($request->ajax()) {

$appointments = Appointment::with([
'patient',
'doctor'

])->latest();

return DataTables::of($appointments)

->addIndexColumn()

->addColumn('patient_name', function ($row) {
return optional($row->patient)->patient_name;
})

->addColumn('doctor_name', function ($row) {
return optional($row->doctor)->doctor_name;
})

->addColumn('appointment_date', function ($row) {
return Carbon::parse($row->appointment_date)
->format('d M Y');
})

->addColumn('appointment_time', function ($row) {

if (!$row->appointment_time) {
return '-';
}

return Carbon::parse($row->appointment_time)
->format('h:i A');
})

->addColumn('action', function ($appointment) {

$html = '';

// OPD Status
if ($appointment->opdVisit) {

$html .= '
<button class="btn btn-secondary btn-sm" disabled>
Checked-in
</button>';
}
elseif ($appointment->appointment_date == now()->toDateString()) {

$html .= '
<a href="'.route(
'opd.create.from.appointment',
$appointment->id
).'" class="btn btn-success btn-sm">
OPD Check-in
</a>';
}
elseif ($appointment->appointment_date > now()->toDateString()) {

$html .= '
<button class="btn btn-warning btn-sm" disabled>
Future Appointment
</button>';
}
else {

$html .= '';
}

// View

if (auth()->user()->can('appointment.view')) {
$html .= '
<a href="'.route(
'appointments.show',
$appointment->id
).'" class="btn btn-info btn-sm">
View
</a>';

}

if (auth()->user()->can('appointment.edit')) {
// Edit
$html .= '
<a href="'.route(
'appointments.edit',
$appointment->id
).'"
class="btn btn-warning btn-sm">
Edit
</a>';

}


if (auth()->user()->can('appointment.edit')) {
// Delete
$html .= '
<form method="POST"
action="'.route(
'appointments.destroy',
$appointment->id
).'"
style="display:inline">

'.csrf_field().'
'.method_field('DELETE').'

<button class="btn btn-danger btn-sm"
onclick="return confirm(\'Delete Appointment?\')">
Delete
</button>

</form>';


}

return $html;
})

->rawColumns(['action'])

->make(true);
}

return view('appointments.index');
}



public function getSlots(Request $request)
{
$request->validate([
'doctor_id' => 'required',
'appointment_date' => 'required|date',
]);

$doctorId = $request->doctor_id;
$date = $request->appointment_date;

$day = Carbon::parse($date)->format('l');

$schedule = DoctorSchedule::with('sessions')
->where('doctor_id', $doctorId)
->where('day_name', $day)
->where('status', true)
->first();

if (!$schedule) {
return response()->json([]);
}

$booked = Appointment::where('doctor_id', $doctorId)
->where('appointment_date', $date)
->pluck('appointment_time')
->toArray();

$response = [];

$selectedDate = Carbon::parse($date)->format('Y-m-d');
$today = Carbon::today()->format('Y-m-d');
$now = Carbon::now();

foreach ($schedule->sessions as $session) {

if (!$session->is_active) {
continue;
}

$slots = [];

$start = Carbon::parse($session->start_time);
$end = Carbon::parse($session->end_time);

while ($start < $end) {

$slotDateTime = Carbon::parse(
$selectedDate . ' ' . $start->format('H:i:s')
);

// Aaj ke expired slots hide karo
if (
$selectedDate === $today &&
$slotDateTime->lte($now)
) {
$start->addMinutes($session->slot_duration);
continue;
}

$time = $start->format('H:i:s');

$slots[] = [
'time' => $time,
'display' => $start->format('h:i A'),
'available' => !in_array($time, $booked),
];

$start->addMinutes($session->slot_duration);
}

// Sirf wahi session add karo jisme slots available hain
if (!empty($slots)) {
$response[] = [
'session_id' => $session->id,
'session_name' => $session->session_name,
'start_time' => Carbon::parse($session->start_time)->format('h:i A'),
'end_time' => Carbon::parse($session->end_time)->format('h:i A'),
'slots' => $slots,
];
}
}

return response()->json($response);
}


/**
* Show the form for creating a new resource.
*/
public function create()
{
abort_unless(auth()->user()->can('appointment.create'), 403);
$patients = Patient::latest()->get();
$doctors = Doctor::latest()->get();
return view('appointments.create',
compact(['patients', 'doctors'])); 

}

/**
* Store a newly created resource in storage.
*/


public function store(Request $request)
{
$request->validate([
'patient_id'       => 'required|exists:patients,id',
'doctor_id'        => 'required|exists:doctors,id',
'appointment_date' => 'required|date|after_or_equal:today',
'appointment_time' => 'required',
'remarks'          => 'nullable|string|max:500',
]);

// Appointment Day
$appointmentDay = Carbon::parse(
$request->appointment_date
)->format('l');

// Doctor Schedule Check
$schedule = DoctorSchedule::where('doctor_id', $request->doctor_id)
->where('day_name', $appointmentDay)
->where('status', 1)
->first();

if (!$schedule) {
return back()
->withInput()
->withErrors([
'appointment_date' =>
"Doctor is not available on {$appointmentDay}."
]);
}

// Appointment Time
$appointmentTime = Carbon::parse(
$request->appointment_time
)->format('H:i:s');

// Find matching session
$session = DoctorScheduleSession::where(
'doctor_schedule_id',
$schedule->id
)
->where('is_active', 1)
->whereTime('start_time', '<=', $appointmentTime)
->whereTime('end_time', '>=', $appointmentTime)
->first();

if (!$session) {
return back()
->withInput()
->withErrors([
'appointment_time' =>
'Selected time is outside doctor schedule.'
]);
}

// Doctor Slot Already Booked
$slotExists = Appointment::where(
'doctor_id',
$request->doctor_id
)
->whereDate(
'appointment_date',
$request->appointment_date
)
->where(
'appointment_time',
$request->appointment_time
)
->exists();

if ($slotExists) {
return back()
->withInput()
->withErrors([
'appointment_time' =>
'This slot is already booked.'
]);
}

// Same Patient Duplicate Check
$patientExists = Appointment::where(
'patient_id',
$request->patient_id
)
->whereDate(
'appointment_date',
$request->appointment_date
)
->exists();

if ($patientExists) {
return back()
->withInput()
->withErrors([
'patient_id' =>
'Patient already has an appointment on this date.'
]);
}

// Session Patient Limit Check
$sessionCount = Appointment::where(
'doctor_id',
$request->doctor_id
)
->whereDate(
'appointment_date',
$request->appointment_date
)
->whereBetween(
'appointment_time',
[
$session->start_time,
$session->end_time
]
)
->count();

if ($sessionCount >= $session->max_patients) {

return back()
->withInput()
->withErrors([
'appointment_date' =>
'Maximum patient limit reached for this session.'
]);
}

// Token Number
$tokenNo = Appointment::where(
'doctor_id',
$request->doctor_id
)
->whereDate(
'appointment_date',
$request->appointment_date
)
->max('token_no');

$tokenNo = $tokenNo ? $tokenNo + 1 : 1;

// Doctor Details
$doctor = Doctor::findOrFail(
$request->doctor_id
);


$appointmentNo = 'APT-' .Carbon::parse($request->appointment_date)->format('Ymd')
. '-' .
str_replace(':', '', $request->appointment_time)
. '-' .
str_pad($tokenNo, 3, '0', STR_PAD_LEFT);

// Save Appointment
Appointment::create([
'appointment_no'   => $appointmentNo,	
'token_no'         => $tokenNo,
'patient_id'       => $request->patient_id,
'doctor_id'        => $request->doctor_id,

// Recommended column
'doctor_schedule_session_id' => $session->id,

'appointment_date' => $request->appointment_date,
'appointment_time' => $request->appointment_time,

'consultation_fee' => $doctor->consultation_fee,

'status'           => 'Booked',

'remarks'          => $request->remarks,
]);

return redirect()
->route('appointments.index')
->with(
'success',
'Appointment booked successfully.'
);
}





public function show(Appointment $appointment)
{
return view(
'appointments.show',
compact('appointment')
);
}

public function edit(Appointment $appointment)
{
$patients = Patient::all();
$doctors = Doctor::all();

return view(
'appointments.edit',
compact(
'appointment',
'patients',
'doctors'
)
);
}



public function update(Request $request, $id)
{
$request->validate([
'patient_id'       => 'required|exists:patients,id',
'doctor_id'        => 'required|exists:doctors,id',
'appointment_date' => 'required|date|after_or_equal:today',
'appointment_time' => 'required',
'remarks'          => 'nullable|string|max:500',
]);

$appointment = Appointment::findOrFail($id);

// Appointment day
$appointmentDay = Carbon::parse($request->appointment_date)
->format('l');

// Doctor schedule check
$schedule = DoctorSchedule::where('doctor_id', $request->doctor_id)
->where('day_name', $appointmentDay)
->where('status', 1)
->first();

if (!$schedule) {
return redirect()->back()
->withInput()
->withErrors([
'appointment_date' =>
"Doctor is not available on {$appointmentDay}."
]);
}

// Time validation
$appointmentTime = Carbon::parse($request->appointment_time)
->format('H:i:s');

$startTime = Carbon::parse($schedule->start_time)
->format('H:i:s');

$endTime = Carbon::parse($schedule->end_time)
->format('H:i:s');

if ($appointmentTime < $startTime || $appointmentTime > $endTime) {
return redirect()->back()
->withInput()
->withErrors([
'appointment_time' =>
'Selected time is outside doctor schedule.'
]);
}

// Duplicate doctor slot (EXCLUDE CURRENT APPOINTMENT)
$slotExists = Appointment::where('doctor_id', $request->doctor_id)
->whereDate('appointment_date', $request->appointment_date)
->where('appointment_time', $request->appointment_time)
->where('id', '!=', $id)
->exists();

if ($slotExists) {
return redirect()->back()
->withInput()
->withErrors([
'appointment_time' =>
'This slot is already booked.'
]);
}

// Same patient duplicate (EXCLUDE CURRENT APPOINTMENT)
$patientExists = Appointment::where('patient_id', $request->patient_id)
->whereDate('appointment_date', $request->appointment_date)
->where('id', '!=', $id)
->exists();

if ($patientExists) {
return redirect()->back()
->withInput()
->withErrors([
'patient_id' =>
'Patient already has an appointment on this date.'
]);
}

// Max patient validation
if (!is_null($schedule->max_patients) && $schedule->max_patients > 0) {

$todayCount = Appointment::where('doctor_id', $request->doctor_id)
->whereDate('appointment_date', $request->appointment_date)
->where('id', '!=', $id)
->count();

if ($todayCount >= $schedule->max_patients) {
return redirect()->back()
->withInput()
->withErrors([
'appointment_date' =>
'Maximum patient limit reached.'
]);
}
}

// Doctor fee (update if doctor changed)
$doctor = Doctor::findOrFail($request->doctor_id);

// Update Appointment
$appointment->update([
'patient_id'       => $request->patient_id,
'doctor_id'        => $request->doctor_id,
'appointment_date' => $request->appointment_date,
'appointment_time' => $request->appointment_time,
'consultation_fee' => $doctor->consultation_fee,
'remarks'          => $request->remarks,
]);

return redirect()
->route('appointments.index')
->with('success', 'Appointment updated successfully.');
}


public function print($id)
{
$appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);

return view('appointments.print', compact('appointment'));
}


public function pdf($id)
{
$appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);

$pdf = Pdf::loadView('appointments.print', compact('appointment'));

return $pdf->download('appointment-'.$appointment->id.'.pdf');
}




public function destroy(
Appointment $appointment
)
{
$appointment->delete();

return redirect()
->route('appointments.index')
->with(
'success',
'Appointment Deleted Successfully'
);
}
}
