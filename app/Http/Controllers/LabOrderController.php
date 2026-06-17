<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabOrder;

class LabOrderController extends Controller
{
public function index()
{
$orders = LabOrder::with(['test','patient','doctor'])
->latest()
->get();

return view('lab_orders.index', compact('orders'));
}

public function pending()
{
$orders = LabOrder::with(['test','patient'])
->where('status','Pending')
->latest()
->get();

return view('lab_orders.pending', compact('orders'));
}

public function processing($id)
{
$order = LabOrder::findOrFail($id);
$order->update(['status' => 'Processing']);

return back()->with('success','Order moved to Processing');
}

public function complete($id)
{
$order = LabOrder::findOrFail($id);
$order->update(['status' => 'Completed']);

return back()->with('success','Order Completed');
}

public function show($id)
{
    $order = LabOrder::with(['patient','doctor','test','consultation'])
        ->findOrFail($id);

    return view('lab_orders.show', compact('order'));
}





}
