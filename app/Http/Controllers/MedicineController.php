<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicineController extends Controller
{

public function index(Request $request)
{
if ($request->ajax()) {

$medicines = Medicine::query()->latest();

return DataTables::of($medicines)

->addIndexColumn()

->addColumn('stock_status', function ($medicine) {

if ($medicine->stock_qty <= $medicine->reorder_level) {
return '<span class="badge badge-danger">
Low Stock
</span>';
}

return '<span class="badge badge-success">
OK
</span>';
})

->addColumn('action', function ($medicine) {

$btn = '';

// Edit
$btn .= '
<a href="'.route('medicines.edit', $medicine->id).'"
class="btn btn-warning btn-sm">
Edit
</a> ';

// Delete
$btn .= '
<form action="'.route('medicines.destroy', $medicine->id).'"
method="POST"
style="display:inline">

'.csrf_field().'
'.method_field('DELETE').'

<button type="submit"
class="btn btn-danger btn-sm"
onclick="return confirm(\'Are you sure you want to delete this medicine?\')">
Delete
</button>

</form>';

return $btn;
})

->rawColumns([
'stock_status',
'action'
])

->make(true);
}

return view('medicines.index');
}

public function create()
{
return view('medicines.create');
}

public function store(Request $request)
{
$request->validate([
'medicine_name' => 'required',
'selling_price' => 'required',
]);

Medicine::create($request->all());

return redirect()
->route('medicines.index')
->with('success','Medicine Added');
}

public function edit(Medicine $medicine)
{
return view('medicines.edit', compact('medicine'));
}

public function update(Request $request, Medicine $medicine)
{
$medicine->update($request->all());

return redirect()
->route('medicines.index')
->with('success','Medicine Updated');
}

public function destroy(Medicine $medicine)
{
$medicine->delete();

return redirect()
->route('medicines.index')
->with('success','Medicine Deleted');
}
}