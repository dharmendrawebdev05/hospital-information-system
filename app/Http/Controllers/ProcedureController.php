<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProcedureController extends Controller
{
public function index(Request $request)
{
if ($request->ajax()) {

$procedures = Procedure::with('department')->latest();

return DataTables::of($procedures)

->addIndexColumn()

->addColumn('department', function ($procedure) {
return $procedure->department->name ?? '-';
})

->addColumn('action', function ($procedure) {

$btn = '';

$btn .= '<a href="'.route('procedures.show',$procedure->id).'"
class="btn btn-info btn-sm">
View
</a> ';

$btn .= '<a href="'.route('procedures.edit',$procedure->id).'"
class="btn btn-warning btn-sm">
Edit
</a> ';

$btn .= '<form action="'.route('procedures.destroy',$procedure->id).'"
method="POST"
style="display:inline">

'.csrf_field().'
'.method_field('DELETE').'

<button type="submit"
class="btn btn-danger btn-sm"
onclick="return confirm(\'Delete Procedure?\')">
Delete
</button>

</form>';

return $btn;
})

->rawColumns(['action'])

->make(true);
}

return view('procedures.index');
}

public function create()
{
$departments = Department::where('is_active', 1)->get();

return view('procedures.create', compact('departments'));
}

public function store(Request $request)
{
$request->validate([
'procedure_name' => 'required',
'department_id' => 'required',
'category' => 'required',
'charges' => 'required|numeric',
]);

$procedureCode = 'PROC' . str_pad(
Procedure::count() + 1,
4,
'0',
STR_PAD_LEFT
);

Procedure::create([
'procedure_code' => $procedureCode,
'procedure_name' => $request->procedure_name,
'department_id' => $request->department_id,
'category' => $request->category,
'charges' => $request->charges,
'description' => $request->description,
'status' => $request->status,
]);

return redirect()
->back()
->with('success', 'Procedure created successfully.');
}

public function show($id)
{
$procedure = Procedure::with('department')->findOrFail($id);

return view('procedures.show', compact('procedure'));
}

public function edit($id)
{
$procedure = Procedure::findOrFail($id);

$departments = Department::all();

return view('procedures.edit', compact(
'procedure',
'departments'
));
}

public function update(Request $request, $id)
{
$request->validate([
'procedure_name' => 'required',
'department_id' => 'required',
'category' => 'required',
'charges' => 'required|numeric',
]);

$procedure = Procedure::findOrFail($id);

$procedure->update([
'procedure_name' => $request->procedure_name,
'department_id' => $request->department_id,
'category' => $request->category,
'charges' => $request->charges,
'description' => $request->description,
'status' => $request->status,
]);

return redirect()
->route('procedures.index')
->with('success', 'Procedure updated successfully.');
}

public function destroy($id)
{
Procedure::findOrFail($id)->delete();

return redirect()
->route('procedures.index')
->with('success', 'Procedure deleted successfully.');
}
}