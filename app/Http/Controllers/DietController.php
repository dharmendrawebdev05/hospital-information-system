<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DietController extends Controller
{
public function index(Request $request)
{
if ($request->ajax()) {

$diets = Diet::latest();

return DataTables::of($diets)

->addIndexColumn()

->addColumn('action', function ($diet) {

$btn = '';

$btn .= '<a href="' . route('diets.show', $diet->id) . '"
class="btn btn-info btn-sm">
View
</a> ';

$btn .= '<a href="' . route('diets.edit', $diet->id) . '"
class="btn btn-warning btn-sm">
Edit
</a> ';

$btn .= '<form action="' . route('diets.destroy', $diet->id) . '"
method="POST"
style="display:inline">

' . csrf_field() . '
' . method_field('DELETE') . '

<button type="submit"
class="btn btn-danger btn-sm"
onclick="return confirm(\'Delete Diet?\')">
Delete
</button>

</form>';

return $btn;
})

->rawColumns(['action'])

->make(true);
}

return view('diets.index');
}

public function create()
{
return view('diets.create');
}

public function store(Request $request)
{
$request->validate([
'diet_name' => 'required|string|max:255',
'category'  => 'required',
'status'    => 'required',
]);

$dietCode = 'DIET' . str_pad(
Diet::count() + 1,
4,
'0',
STR_PAD_LEFT
);

Diet::create([
'diet_code'   => $dietCode,
'diet_name'   => $request->diet_name,
'category'    => $request->category,
'description' => $request->description,
'status'      => $request->status,
]);

return redirect()
->route('diets.index')
->with('success', 'Diet created successfully.');
}

public function show($id)
{
$diet = Diet::findOrFail($id);

return view('diets.show', compact('diet'));
}

public function edit($id)
{
$diet = Diet::findOrFail($id);

return view('diets.edit', compact('diet'));
}

public function update(Request $request, $id)
{
$request->validate([
'diet_name' => 'required|string|max:255',
'category'  => 'required',
'status'    => 'required',
]);

$diet = Diet::findOrFail($id);

$diet->update([
'diet_name'   => $request->diet_name,
'category'    => $request->category,
'description' => $request->description,
'status'      => $request->status,
]);

return redirect()
->route('diets.index')
->with('success', 'Diet updated successfully.');
}

public function destroy($id)
{
$diet = Diet::findOrFail($id);

$diet->delete();

return redirect()
->route('diets.index')
->with('success', 'Diet deleted successfully.');
}
}       