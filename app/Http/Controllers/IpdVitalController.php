<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IpdVital;
use App\Models\IpdAdmission;


class IpdVitalController extends Controller
{
   public function index($admissionId)
    {
    $admission = IpdAdmission::findOrFail($admissionId);

    $vitals = IpdVital::where('admission_id',$admissionId)
                ->latest()
                ->get();

    return view(
        'ipd_vitals.index',
        compact('admission','vitals')
    );
}


public function create($admissionId)
{
    $admission = IpdAdmission::findOrFail($admissionId);

    return view(
        'ipd_vitals.create',
        compact('admission')
    );
}


public function store(Request $request,$admissionId)
{
    $request->validate([
        'recorded_at'=>'required'
    ]);

    IpdVital::create([

        'admission_id'=>$admissionId,

        'recorded_at'=>$request->recorded_at,

        'temperature'=>$request->temperature,
        'pulse'=>$request->pulse,

        'respiratory_rate'=>$request->respiratory_rate,

        'bp_systolic'=>$request->bp_systolic,
        'bp_diastolic'=>$request->bp_diastolic,

        'spo2'=>$request->spo2,
        'blood_sugar'=>$request->blood_sugar,

        'weight'=>$request->weight,

        'remarks'=>$request->remarks
    ]);

    return redirect()
        ->route('ipd.vitals.index',$admissionId)
        ->with('success','Vitals recorded successfully');
}










}
