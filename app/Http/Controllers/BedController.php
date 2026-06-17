<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class BedController extends Controller
{

public function index(Request $request)
{
if ($request->ajax()) {

$data = Bed::with('ward')->select('beds.*');

return DataTables::of($data)
->addIndexColumn()

->addColumn('ward_name', function($row){
return $row->ward->ward_name ?? '-';
})

->editColumn('status', function($row){

if ($row->status == 'Available') {
return '<span class="badge badge-success">Available</span>';
}

if ($row->status == 'Occupied') {
return '<span class="badge badge-danger">Occupied</span>';
}

if ($row->status == 'Maintenance') {
return '<span class="badge badge-warning">Maintenance</span>';
}

return '<span class="badge badge-secondary">'.$row->status.'</span>';
})

->addColumn('action', function($row){

return '
<a href="'.route('beds.show',$row->id).'" class="btn btn-info btn-sm">View</a>
<a href="'.route('beds.edit',$row->id).'" class="btn btn-warning btn-sm">Edit</a>
<form method="POST" action="'.route('beds.destroy',$row->id).'" style="display:inline">
'.csrf_field().'
'.method_field("DELETE").'
<button class="btn btn-danger btn-sm" onclick="return confirm(\'Delete Bed?\')">Delete</button>
</form>';
})

->rawColumns(['status','action'])
->make(true);
}

return view('beds.index');
}




public function create()
{
$wards = Ward::where('is_active', 1)
->orderBy('ward_name')
->get();

return view('beds.create', compact('wards'));
}

public function store(Request $request)
{
$request->validate([
'ward_id' => 'required|exists:wards,id',
'bed_no'  => 'required|max:50',
'room_no' => 'nullable|max:50',
'status'  => 'required',
]);

Bed::create([
'ward_id' => $request->ward_id,
'bed_no'  => $request->bed_no,
'room_no' => $request->room_no,
'status'  => $request->status,
'remarks' => $request->remarks,
]);

$this->updateWardBedCount($request->ward_id);

return redirect()
->route('beds.index')
->with('success', 'Bed created successfully');
}

public function show(Bed $bed)
{
$bed->load('ward');

return view('beds.show', compact('bed'));
}

public function edit(Bed $bed)
{
$wards = Ward::where('is_active', 1)->get();

return view('beds.edit', compact('bed', 'wards'));
}

public function update(Request $request, Bed $bed)
{
    $request->validate([
        'ward_id' => 'required|exists:wards,id',

        'bed_no' => [
            'required',
            'max:50',
            Rule::unique('beds')
                ->ignore($bed->id)
                ->where(function ($query) use ($request) {
                    return $query->where('ward_id', $request->ward_id);
                }),
        ],

        'room_no' => 'nullable|max:50',
        'status'  => 'required',
    ]);

    $oldWard = $bed->ward_id;

    $bed->update([
        'ward_id' => $request->ward_id,
        'bed_no'  => $request->bed_no,
        'room_no' => $request->room_no,
        'status'  => $request->status,
        'remarks' => $request->remarks,
    ]);

    $this->updateWardBedCount($oldWard);
    $this->updateWardBedCount($request->ward_id);

    return redirect()
        ->route('beds.index')
        ->with('success', 'Bed updated successfully');
}

public function destroy(Bed $bed)
{
if ($bed->status == 'Occupied') {

return back()->with(
'error',
'Occupied bed cannot be deleted.'
);
}

$wardId = $bed->ward_id;

$bed->delete();

$this->updateWardBedCount($wardId);

return redirect()
->route('beds.index')
->with('success', 'Bed deleted successfully');
}

private function updateWardBedCount($wardId)
{
$ward = Ward::find($wardId);

if ($ward) {

$ward->update([
'total_beds' => Bed::where(
'ward_id',
$wardId
)->count()
]);
}
}
}