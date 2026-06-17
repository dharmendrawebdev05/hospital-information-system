<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\IpdRound;
use App\Models\IpdAdmission;
use Illuminate\Http\Request;

class IpdRoundController extends Controller
{
public function index($admissionId)
{
$admission = IpdAdmission::with('patient')
->findOrFail($admissionId);

$rounds = IpdRound::with('doctor')
->where('admission_id',$admissionId)
->latest('round_time')
->get();

return view(
'ipd_rounds.index',
compact('admission','rounds')
);
}

public function create($admissionId)
{
$admission = IpdAdmission::findOrFail($admissionId);

$doctors = Doctor::all();

return view(
'ipd_rounds.create',
compact('admission','doctors')
);
}

public function store(Request $request,$admissionId)
{
$request->validate([
'doctor_id' => 'required',
'round_time' => 'required'
]);

IpdRound::create([

'admission_id' => $admissionId,

'doctor_id' => $request->doctor_id,

'round_time' => $request->round_time,

'chief_complaint' => $request->chief_complaint,

'clinical_notes' => $request->clinical_notes,

'diagnosis' => $request->diagnosis,

'treatment_plan' => $request->treatment_plan,

'doctor_orders' => $request->doctor_orders
]);

return redirect()
->route('ipd.rounds.index',$admissionId)
->with('success','Doctor round added successfully.');
}
}