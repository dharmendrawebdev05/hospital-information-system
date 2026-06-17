<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\DoctorScheduleSession;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DoctorScheduleSessionController extends Controller
{


    
public function index(
Request $request,
DoctorSchedule $doctorSchedule
)
{
if ($request->ajax()) {

$query = $doctorSchedule
->sessions()
->latest();

return DataTables::of($query)

->addIndexColumn()

->editColumn(
'start_time',
function ($row) {
return date(
'h:i A',
strtotime(
$row->start_time
)
);
}
)

->editColumn(
'end_time',
function ($row) {
return date(
'h:i A',
strtotime(
$row->end_time
)
);
}
)

->editColumn(
'is_active',
function ($row) {

return $row->is_active
? '<span class="badge badge-success">
Active
</span>'
: '<span class="badge badge-danger">
Inactive
</span>';
}
)

->addColumn(
'action',
function ($row)
use ($doctorSchedule)
{
$edit =
route(
'doctor-schedules.sessions.edit',
[
$doctorSchedule->id,
$row->id
]
);

$delete =
route(
'doctor-schedules.sessions.destroy',
[
$doctorSchedule->id,
$row->id
]
);

return '

<a href="'.$edit.'"
class="btn btn-primary btn-sm">
<i class="fas fa-edit"></i>
</a>

<form
action="'.$delete.'"
method="POST"
style="display:inline">

'.csrf_field().'

'.method_field('DELETE').'

<button
class="btn btn-danger btn-sm"
onclick="
return confirm(
\'Delete Session?\')">

<i class="fas fa-trash"></i>

</button>

</form>

';
}
)

->rawColumns([
'is_active',
'action'
])

->make(true);
}

return view(
'doctor-schedule-sessions.index',
compact('doctorSchedule')
);
}

public function create(
DoctorSchedule $doctorSchedule
)
{
return view(
'doctor-schedule-sessions.create',
compact('doctorSchedule')
);
}

public function store(
Request $request,
DoctorSchedule $doctorSchedule
)
{
$request->validate([

'session_name' =>
'required|max:100',

'start_time' =>
'required',

'end_time' =>
'required|after:start_time',

'slot_duration' =>
'required|integer|min:5',

'max_patients' =>
'required|integer|min:1',

'is_active' =>
'nullable'
]);

/*
Prevent overlap
*/

$exists =
$doctorSchedule
->sessions()
->where(
'session_name',
$request->session_name
)
->exists();

if ($exists)
{
return back()
->withInput()
->withErrors(
'Session already exists.'
);
}

$doctorSchedule
->sessions()
->create([

'session_name' =>
$request->session_name,

'start_time' =>
$request->start_time,

'end_time' =>
$request->end_time,

'slot_duration' =>
$request->slot_duration,

'max_patients' =>
$request->max_patients,

'is_active' =>
$request->has(
'is_active'
)
]);

return redirect()
->route(
'doctor-schedules.sessions.index',
$doctorSchedule->id
)
->with(
'success',
'Session Created Successfully.'
);
}

public function show(
DoctorSchedule $doctorSchedule,
DoctorScheduleSession $session
)
{
return view(
'doctor-schedule-sessions.show',
compact(
'doctorSchedule',
'session'
)
);
}

public function edit(
DoctorSchedule $doctorSchedule,
DoctorScheduleSession $session
)
{
return view(
'doctor-schedule-sessions.edit',
compact(
'doctorSchedule',
'session'
)
);
}

public function update(
Request $request,
DoctorSchedule $doctorSchedule,
DoctorScheduleSession $session
)
{
$request->validate([

'session_name' =>
'required|max:100',

'start_time' =>
'required',

'end_time' =>
'required|after:start_time',

'slot_duration' =>
'required|integer|min:5',

'max_patients' =>
'required|integer|min:1'
]);

$session->update([

'session_name' =>
$request->session_name,

'start_time' =>
$request->start_time,

'end_time' =>
$request->end_time,

'slot_duration' =>
$request->slot_duration,

'max_patients' =>
$request->max_patients,

'is_active' =>
$request->has(
'is_active'
)
]);

return redirect()
->route(
'doctor-schedules.sessions.index',
$doctorSchedule->id
)
->with(
'success',
'Session Updated Successfully.'
);
}

public function destroy(
DoctorSchedule $doctorSchedule,
DoctorScheduleSession $session
)
{
$session->delete();

return redirect()
->route(
'doctor-schedules.sessions.index',
$doctorSchedule->id
)
->with(
'success',
'Session Deleted Successfully.'
);
}
}