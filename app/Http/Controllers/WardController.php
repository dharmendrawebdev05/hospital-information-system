<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class WardController extends Controller
{


public function index(Request $request)
{
if ($request->ajax()) {

$data = Ward::select('*');

return DataTables::of($data)
->addIndexColumn()

->editColumn('is_active', function($row) {
return $row->is_active
? '<span class="badge badge-success">Active</span>'
: '<span class="badge badge-danger">Inactive</span>';
})

->addColumn('action', function($row) {

$btn = '<a href="'.route('wards.show',$row->id).'" class="btn btn-info btn-sm">View</a> ';
$btn .= '<a href="'.route('wards.edit',$row->id).'" class="btn btn-warning btn-sm">Edit</a> ';
$btn .= '<form method="POST" action="'.route('wards.destroy',$row->id).'" style="display:inline">
'.csrf_field().'
'.method_field("DELETE").'
<button class="btn btn-danger btn-sm" onclick="return confirm(\'Delete Ward?\')">Delete</button>
</form>';

return $btn;
})

->rawColumns(['is_active','action'])
->make(true);
}

return view('wards.index');
}



public function create()
{
return view('wards.create');
}


public function store(Request $request)
{
$request->validate([
'ward_name' => 'required|max:255|unique:wards,ward_name',
'ward_type' => 'required|in:General,Semi Private,Private,ICU,NICU,PICU',
'floor_no'  => 'required|integer|min:1',
]);

try {

DB::transaction(function () use ($request) {

$ward = Ward::create([
'ward_name' => trim($request->ward_name),
'ward_type' => $request->ward_type,
'floor_no'  => $request->floor_no,
'total_beds'=> $request->capacity, // will be updated when beds are created
'is_active' => $request->has('is_active'),
]);

// OPTIONAL: log creation (if you have audit system)
// WardLog::create([
//     'ward_id' => $ward->id,
//     'action' => 'created',
//     'created_by' => auth()->id()
// ]);

});

return redirect()
->route('wards.index')
->with('success', 'Ward created successfully');

} catch (\Exception $e) {

return back()
->withInput()
->with('error', 'Something went wrong: ' . $e->getMessage());
}
}




public function show(Ward $ward)
{
$ward->load('beds');

return view('wards.show', compact('ward'));
}

public function edit(Ward $ward)
{
return view('wards.edit', compact('ward'));
}

public function update(Request $request, Ward $ward)
{
$request->validate([
'ward_name' => 'required|max:255|unique:wards,ward_name,' . $ward->id,
'ward_type' => 'required',
'floor_no'  => 'required|integer|min:1',
]);

$ward->update([
'ward_name' => $request->ward_name,
'ward_type' => $request->ward_type,
'floor_no'  => $request->floor_no,
'is_active' => $request->has('is_active'),
]);

return redirect()
->route('wards.index')
->with('success', 'Ward updated successfully');
}

public function destroy(Ward $ward)
{
if ($ward->beds()->count() > 0) {
return back()->with(
'error',
'Cannot delete ward having beds.'
);
}

$ward->delete();

return redirect()
->route('wards.index')
->with('success', 'Ward deleted successfully');
}
}