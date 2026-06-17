<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabResultController extends Controller
{
    public function create($orderId)
    {
        $order = LabOrder::with('test','patient')->findOrFail($orderId);
        return view('lab_results.create', compact('order'));
    }

    public function store(Request $request, $orderId)
    {
        foreach ($request->parameter as $key => $param) {

            LabResult::create([
                'lab_order_id' => $orderId,
                'parameter' => $param,
                'result' => $request->result[$key],
                'unit' => $request->unit[$key] ?? null,
                'normal_range' => $request->normal_range[$key] ?? null,
                'remarks' => $request->remarks[$key] ?? null,
            ]);
        }

        LabOrder::find($orderId)->update([
            'status' => 'Completed'
        ]);

        return redirect('/lab-orders')->with('success','Report Saved');
    }
}