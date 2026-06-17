<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DoctorScheduleController extends Controller
{
public function index(Request $request)
{
if ($request->ajax()) {

$schedules = DoctorSchedule::with('doctor')->latest();

return DataTables::of($schedules)

->addIndexColumn()

->addColumn('doctor_name', function ($row) {
return optional($row->doctor)->doctor_name ?? '-';
})

->addColumn('action', function ($schedule) {

$btn = '';

// Sessions
$btn .= '
<a href="'.route(
'doctor-schedules.sessions.index',
$schedule->id
).'"
class="btn btn-info btn-sm">
<i class="fas fa-clock"></i> Sessions
</a> ';

// Edit
$btn .= '
<a href="'.route(
'doctor-schedules.edit',
$schedule->id
).'"
class="btn btn-warning btn-sm">
<i class="fas fa-edit"></i> Edit
</a> ';

// Delete
$btn .= '
<form method="POST"
action="'.route(
'doctor-schedules.destroy',
$schedule->id
).'"
style="display:inline">

'.csrf_field().'
'.method_field('DELETE').'

<button class="btn btn-danger btn-sm"
onclick="return confirm(\'Delete Schedule?\')">

<i class="fas fa-trash"></i> Delete

</button>

</form>';

return $btn;
})

->rawColumns(['action'])

->make(true);
}

return view('doctor-schedules.index');
}





public function create()
{
$doctors = Doctor::orderBy('doctor_name')
->get();

return view(
'doctor-schedules.create',
compact('doctors')
);
}

public function store(Request $request)
{
$request->validate([
'doctor_id' => 'required',
'day_name' => 'required',
]);

DoctorSchedule::create([
'doctor_id' => $request->doctor_id,
'day_name' => $request->day_name,
'status' => 1
]);

return redirect()
->route('doctor-schedules.index')
->with(
'success',
'Doctor Schedule Created Successfully'
);
}

public function edit(
DoctorSchedule $doctor_schedule
)
{
$doctors = Doctor::all();

return view(
'doctor-schedules.edit',
compact(
'doctor_schedule',
'doctors'
)
);
}

public function update(
Request $request,
DoctorSchedule $doctor_schedule
)
{
$doctor_schedule->update([
'doctor_id' => $request->doctor_id,
'day_name' => $request->day_name,
'status' => $request->status
]);

return redirect()
->route('doctor-schedules.index')
->with(
'success',
'Doctor Schedule Updated Successfully'
);
}

public function destroy(
DoctorSchedule $doctor_schedule
)
{
$doctor_schedule->delete();

return redirect()
->route('doctor-schedules.index')
->with(
'success',
'Doctor Schedule Deleted Successfully'
);
}
}