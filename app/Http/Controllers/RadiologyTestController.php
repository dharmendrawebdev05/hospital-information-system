<?php

namespace App\Http\Controllers;

use App\Models\RadiologyTest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RadiologyTestController extends Controller
{
public function index(Request $request)
{
if ($request->ajax()) {

$tests = RadiologyTest::latest();

return DataTables::of($tests)

->addIndexColumn()

->editColumn('price', function ($row) {
return '₹ ' . number_format($row->price, 2);
})

->addColumn('status', function ($row) {

return $row->is_active
? '<span class="badge badge-success">Active</span>'
: '<span class="badge badge-danger">Inactive</span>';
})

->addColumn('action', function ($row) {

$btn = '';

$btn .= '
<a href="'.route('radiology-tests.show',$row->id).'"
class="btn btn-info btn-sm">
View
</a> ';

$btn .= '
<a href="'.route('radiology-tests.edit',$row->id).'"
class="btn btn-warning btn-sm">
Edit
</a> ';

$btn .= '
<form action="'.route('radiology-tests.destroy',$row->id).'"
method="POST"
style="display:inline">

'.csrf_field().'
'.method_field('DELETE').'

<button class="btn btn-danger btn-sm"
onclick="return confirm(\'Delete Test?\')">
Delete
</button>

</form>';

return $btn;
})

->rawColumns([
'status',
'action'
])

->make(true);
}

return view('radiology_tests.index');
}

public function create()
{
return view('radiology_tests.create');
}

public function store(Request $request)
{
$request->validate([

'test_code' => 'required|unique:radiology_tests',
'test_name' => 'required',
'modality' => 'required',
'price' => 'required|numeric'
]);

RadiologyTest::create($request->all());

return redirect()
->route('radiology-tests.index')
->with('success', 'Radiology Test Added');
}

public function show(RadiologyTest $radiology_test)
{
return view(
'radiology_tests.show',
compact('radiology_test')
);
}

public function edit(RadiologyTest $radiology_test)
{
return view(
'radiology_tests.edit',
compact('radiology_test')
);
}

public function update(Request $request,
RadiologyTest $radiology_test)
{
$request->validate([

'test_code' =>
'required|unique:radiology_tests,test_code,'.
$radiology_test->id,

'test_name' => 'required',
'modality' => 'required',
'price' => 'required|numeric'
]);

$radiology_test->update($request->all());

return redirect()
->route('radiology-tests.index')
->with('success', 'Updated Successfully');
}

public function destroy(RadiologyTest $radiology_test)
{
$radiology_test->delete();

return redirect()
->route('radiology-tests.index')
->with('success', 'Deleted Successfully');
}
}