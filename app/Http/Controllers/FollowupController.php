<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Consultation;

class FollowupController extends Controller
{
public function index(Request $request)
{
if ($request->ajax()) {


$data = Consultation::with([
    'opdVisit.patient',
    'opdVisit.doctor'
])
->whereNotNull('followup_date')
->whereDate('followup_date', '>=', now()->toDateString())
->latest('followup_date');


return DataTables::of($data)

->addIndexColumn()

->addColumn('patient_name', function ($row) {
return optional($row->opdVisit->patient)->patient_name;
})

->addColumn('doctor_name', function ($row) {
return optional($row->opdVisit->doctor)->doctor_name;
})

->addColumn('followup_date', function ($row) {
return \Carbon\Carbon::parse(
$row->followup_date
)->format('d M Y');
})

->addColumn('status', function ($row) {

if ($row->followup_date < now()->toDateString()) {
return '<span class="badge badge-danger">Overdue</span>';
}

if ($row->followup_date == now()->toDateString()) {
return '<span class="badge badge-success">Today</span>';
}

return '<span class="badge badge-warning">Upcoming</span>';
})

->addColumn('action', function ($row) {

return '
<a href="'.route(
'patients.show',
$row->opdVisit->patient_id
).'"
class="btn btn-info btn-sm">
History
</a>';
})

->rawColumns(['status','action'])
->make(true);
}

return view('followups.index');
}
}
