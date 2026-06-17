<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\IpdMedicationOrder;
use App\Models\IpdAdmission;
use App\Models\DoctorOrder;
use App\Models\MedicationAdministration;


class IpdMedicationController extends Controller
{


public function index($admissionId)
{
    $admission = IpdAdmission::with('patient')
        ->findOrFail($admissionId);

    $medications = IpdMedicationOrder::with('medicine')
        ->where('admission_id', $admissionId)
        ->latest()
        ->get();

    return view('ipd_medications.index', compact('admission','medications'));
}


    public function storeFromOrder($orderId)
        {
    $order = DoctorOrder::findOrFail($orderId);

    IpdMedicationOrder::create([
        'admission_id' => $order->admission_id,
        'doctor_id' => $order->doctor_id,
        'doctor_order_id' => $order->id,
        'medicine_id' => $order->medicine_id ?? 1, // assume mapped
        'dose' => '650mg',
        'frequency' => '1-0-1',
        'duration' => 5,
        'start_date' => now(),
    ]);

    return back()->with('success','Medication activated');
        }


        public function giveDose($id)
            {
    $order = IpdMedicationOrder::findOrFail($id);

    MedicationAdministration::create([
        'ipd_medication_order_id' => $id,
        'given_at' => now(),
        'status' => 'given',
        'nurse_id' => auth()->id(),
    ]);

    return back()->with('success','Dose given recorded');
        }









}
