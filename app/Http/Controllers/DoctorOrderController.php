<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorOrder;
use App\Models\IpdAdmission;

class DoctorOrderController extends Controller
{
public function index($admissionId)
{
$admission = IpdAdmission::with('patient')
->findOrFail($admissionId);

$orders = DoctorOrder::with('doctor')
->where('admission_id',$admissionId)
->latest()
->get();

return view(
'doctor_orders.index',
compact('admission','orders')
);
}

public function create($admissionId)
{
$admission = IpdAdmission::with('doctor')
->findOrFail($admissionId);

return view(
'doctor_orders.create',
compact('admission')
);
}

public function store(Request $request,$admissionId)
{
$request->validate([
'order_type'=>'required',
'order_name'=>'required',
]);

$admission = IpdAdmission::findOrFail($admissionId);

DoctorOrder::create([

'admission_id' => $admissionId,

'doctor_id' => $admission->doctor_id,

'order_type' => $request->order_type,

'order_name' => $request->order_name,

'instructions' => $request->instructions,

'ordered_at' => now(),
]);

return redirect()
->route('ipd.orders.index',$admissionId)
->with('success','Order created successfully.');
}


public function updateStatus(Request $request,$id)
{
$order = DoctorOrder::findOrFail($id);

$order->update([
'status' => $request->status
]);

return back()
->with('success','Status updated.');
}





}