<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpdVisit;

class PrintController extends Controller
{
public function prescription($id)
{
$visit = OpdVisit::with([
'patient',
'doctor',
'consultation.prescriptions.medicine'
])->findOrFail($id);

return view('print.opd.prescription', compact('visit'));
}

public function lab($id)
{
$visit = OpdVisit::with([
'patient',
'doctor',
'consultation.labOrders.test'
])->findOrFail($id);

return view('print.opd.lab', compact('visit'));
}

public function radiology($id)
{
$visit = OpdVisit::with([
'patient',
'doctor',
'consultation.radiologyOrders.test'
])->findOrFail($id);

return view('print.opd.radiology', compact('visit'));
}


public function procedure($id)
{
    $visit = OpdVisit::with([
        'patient',
        'doctor',
        'consultation.procedureOrders.procedure'
    ])->findOrFail($id);

    return view('print.opd.procedure', compact('visit'));
}



}