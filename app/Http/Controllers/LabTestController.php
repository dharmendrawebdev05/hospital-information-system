<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabTest;
use Yajra\DataTables\Facades\DataTables;

class LabTestController extends Controller
{

public function index(Request $request)
{
if ($request->ajax()) {

$tests = LabTest::query()->latest();

return DataTables::of($tests)

->addIndexColumn()

->editColumn('price', function ($test) {
return '₹' . number_format($test->price, 2);
})

->addColumn('action', function ($test) {

$btn = '';

// Edit
$btn .= '
<a href="'.route('lab-tests.edit', $test->id).'"
class="btn btn-warning btn-sm">
Edit
</a> ';

// Delete
$btn .= '
<form method="POST"
action="'.route('lab-tests.destroy', $test->id).'"
style="display:inline;">

'.csrf_field().'
'.method_field('DELETE').'

<button class="btn btn-danger btn-sm"
onclick="return confirm(\'Delete Test?\')">
Delete
</button>

</form>';

return $btn;
})

->rawColumns(['action'])

->make(true);
}

return view('lab_tests.index');
}

public function create()
{
return view('lab_tests.create');
}

public function store(Request $request)
{
$request->validate([
'test_name' => 'required',
'price' => 'required|numeric|min:0'
]);

LabTest::create($request->all());

return redirect()->route('lab-tests.index')
->with('success', 'Lab Test Created');
}

public function edit(LabTest $lab_test)
{
return view('lab_tests.edit', ['test' => $lab_test]);
}

public function update(Request $request, LabTest $lab_test)
{
$lab_test->update($request->all());

return redirect()->route('lab-tests.index')
->with('success', 'Updated');
}

public function destroy(LabTest $lab_test)
{
$lab_test->delete();

return back()->with('success', 'Deleted');
}
}