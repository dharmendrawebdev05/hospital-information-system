<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
/**
* LISTING (YAJRA SERVER SIDE)
*/


public function index(Request $request)
{
if ($request->ajax()) {

$data = Department::select(['id','name','code','is_active']);

return DataTables::of($data)
->addIndexColumn() // 🔥 THIS IS REQUIRED

->addColumn('status', function($row){
return $row->is_active
? '<span class="badge badge-success">Active</span>'
: '<span class="badge badge-danger">Blocked</span>';
})

->addColumn('action', function($row){
return '
<a href="'.route('departments.edit',$row->id).'" class="btn btn-sm btn-primary">Edit</a>
<a href="'.route('departments.toggle',$row->id).'" class="btn btn-sm btn-warning">Toggle</a>
';
})

->rawColumns(['status','action'])
->make(true);
}

return view('departments.index');
}


/**
* CREATE
*/
public function create()
{
return view('departments.create');
}

/**
* STORE
*/
public function store(Request $request)
{
$request->validate([
'name' => 'required|string|max:255',
'code' => 'required|string|max:20|unique:departments,code',
]);

Department::create([
'name' => $request->name,
'code' => strtoupper($request->code),
'description' => $request->description,
'is_active' => 1,
]);

return redirect()->route('departments.index')
->with('success','Department created successfully');
}

/**
* EDIT
*/
public function edit($id)
{
$department = Department::findOrFail($id);
return view('departments.edit', compact('department'));
}

/**
* UPDATE
*/
public function update(Request $request, $id)
{
$department = Department::findOrFail($id);

$request->validate([
'name' => 'required|string|max:255',
'code' => 'required|string|max:20|unique:departments,code,' . $id,
]);

$department->update([
'name' => $request->name,
'code' => strtoupper($request->code),
'description' => $request->description,
'is_active' => $request->is_active ?? 1,
]);

return redirect()->route('departments.index')
->with('success','Department updated successfully');
}

/**
* DELETE
*/
public function destroy($id)
{
Department::findOrFail($id)->delete();

return back()->with('success','Department deleted successfully');
}

/**
* TOGGLE ACTIVE/BLOCK
*/
public function toggle($id)
{
$dept = Department::findOrFail($id);

$dept->is_active = !$dept->is_active;
$dept->save();

return back()->with('success','Status updated');
}
}