<?php

namespace App\Http\Controllers;

use App\Models\OpdVisit;
use App\Models\Medicine;
use App\Models\PharmacyBill;
use App\Models\PharmacyBillItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PharmacyBillController extends Controller
{
/**
* Pharmacy Bill List
*/
public function index()
{
$bills = PharmacyBill::with([
'patient',
'opdVisit'
])
->latest()
->get();

return view(
'pharmacy_bills.index',
compact('bills')
);
}

/**
* Pharmacy Queue
*/
public function queue()
{
$visits = OpdVisit::with([
'patient',
'doctor',
'consultation'
])
->where('status', 'Completed')
->doesntHave('pharmacyBill')
->get();

return view(
'pharmacy_bills.queue',
compact('visits')
);
}

/**
* Create Bill From OPD
*/
public function createFromOpd($id)
{
$visit = OpdVisit::with([
'patient',
'doctor',
'consultation',
'consultation.prescriptions.medicine'
])->findOrFail($id);

if ($visit->pharmacyBill) {

return redirect()
->route(
'pharmacy-bills.show',
$visit->pharmacyBill->id
);
}

return view(
'pharmacy_bills.create_from_opd',
compact('visit')
);
}

/**
* Save Bill
*/
public function store(Request $request)
{
$request->validate([

'opd_visit_id' => 'required',

'medicine_id' => 'required|array',

'qty' => 'required|array',

'rate' => 'required|array',
]);

DB::beginTransaction();

try {

$visit = OpdVisit::findOrFail(
$request->opd_visit_id
);

$total = 0;

foreach (
$request->medicine_id
as $key => $medicineId
) {

$qty = $request->qty[$key];

$rate = $request->rate[$key];

$total += ($qty * $rate);
}

$bill = PharmacyBill::create([

'bill_no' =>
'PH' .
date('Ymd') .
rand(1000,9999),

'patient_id' =>
$visit->patient_id,

'opd_visit_id' =>
$visit->id,

'bill_date' =>
now()->toDateString(),

'total_amount' =>
$total,

'paid_amount' =>
0,

'status' =>
'Pending',
]);

foreach (
$request->medicine_id
as $key => $medicineId
) {

$qty = $request->qty[$key];

$rate = $request->rate[$key];

PharmacyBillItem::create([

'pharmacy_bill_id' =>
$bill->id,

'medicine_id' =>
$medicineId,

'qty' =>
$qty,

'rate' =>
$rate,

'amount' =>
($qty * $rate),
]);
}

DB::commit();

return redirect()
->route('pharmacy-bills.show', $bill->id)
->with(
'success',
'Pharmacy Bill Created Successfully'
);

} catch (\Exception $e) {

DB::rollBack();

return back()
->withInput()
->with(
'error',
$e->getMessage()
);
}
}

/**
* Bill Details
*/
public function show($id)
{
$bill = PharmacyBill::with([
'patient',
'opdVisit',
'items.medicine'
])->findOrFail($id);

return view(
'pharmacy_bills.show',
compact('bill')
);
}

/**
* Payment
*/
public function payment($id)
{
    $bill = PharmacyBill::with('items.medicine')
        ->findOrFail($id);

    if ($bill->status == 'Dispensed') {

        return back()->with(
            'error',
            'Medicines already dispensed.'
        );
    }

    foreach ($bill->items as $item) {

        $medicine = $item->medicine;

        if ($medicine->stock_qty < $item->qty) {

            return back()->with(
                'error',
                'Insufficient stock for ' .
                $medicine->medicine_name
            );
        }

        $medicine->decrement(
            'stock_qty',
            $item->qty
        );
    }

    $bill->update([

        'paid_amount' => $bill->total_amount,

        'status' => 'Dispensed'

    ]);

    return back()->with(
        'success',
        'Payment received and medicines dispensed.'
    );
}

/**
* Dispense Medicine
*/
public function dispense($id)
{
DB::beginTransaction();

try {

$bill = PharmacyBill::with([
'items.medicine'
])->findOrFail($id);

foreach ($bill->items as $item) {

$medicine = Medicine::find(
$item->medicine_id
);

if (
$medicine->stock_qty <
$item->qty
) {

return back()->with(
'error',
'Insufficient stock for ' .
$medicine->medicine_name
);
}

$medicine->decrement(
'stock_qty',
$item->qty
);
}

DB::commit();

return back()
->with(
'success',
'Medicine Dispensed Successfully'
);

} catch (\Exception $e) {

DB::rollBack();

return back()
->with(
'error',
$e->getMessage()
);
}
}

/**
* Print Bill
*/
public function print($id)
{
$bill = PharmacyBill::with([
'patient',
'items.medicine'
])->findOrFail($id);

return view(
'pharmacy_bills.print',
compact('bill')
);
}
}