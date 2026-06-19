<?php

namespace App\Http\Controllers;

use App\Models\OpdVisit;
use App\Models\Consultation;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\LabOrder;
use App\Models\LabTest;
use App\Models\ProcedureOrder;
use App\Models\RadiologyOrder;
use App\Models\ConsultationVital;



class ConsultationController extends Controller
{

public function store(Request $request, $visitId)
{
$request->validate([
'visit_status' => 'nullable|in:Completed,Followup,Admit,Referred',
'followup_date' => 'nullable|date',
]);

$visit = OpdVisit::findOrFail($visitId);

$consultation = Consultation::create([
'patient_id'           => $visit->patient_id,
'doctor_id'            => $visit->doctor_id,
'opd_visit_id'         => $visit->id,
'source'               => 'OPD',

'chief_complaint'      => $request->chief_complaint,
'history'              => $request->history,
'clinical_examination' => $request->clinical_examination,
'diagnosis'            => $request->diagnosis,
'advice'               => $request->advice,

'followup_date'        => $request->followup_date,
'visit_status'         => $request->visit_status ?? 'Completed',
'progress_notes'       => $request->progress_notes,
]);


ConsultationVital::create([

'consultation_id' => $consultation->id,
'height'          => $request->height,
'weight'          => $request->weight,

'temperature'     => $request->temp,
'pulse'           => $request->pulse,

'bp'  => $request->bp,
'spo2'            => $request->spo2
]);


// Prescriptions
if ($request->filled('medicine_id')) {
foreach ($request->medicine_id as $key => $medicineId) {
if (!$medicineId) continue;

Prescription::create([
'consultation_id' => $consultation->id,
'medicine_id'     => $medicineId,
'dosage'          => $request->dosage[$key] ?? null,
'frequency'       => $request->frequency[$key] ?? null,
'days'            => $request->days[$key] ?? null,
'instruction'     => $request->instruction[$key] ?? null,
]);
}
}

// Lab Orders
if ($request->filled('lab_test_id')) {
foreach ($request->lab_test_id as $key => $testId) {
if (!$testId) continue;

LabOrder::create([
'consultation_id' => $consultation->id,
'lab_test_id'     => $testId,
'priority'        => $request->lab_priority[$key] ?? 'Routine',
'instruction'     => $request->lab_instruction[$key] ?? null,
'status'          => 'Ordered',
]);
}
}

// Radiology Orders
if ($request->filled('radiology_test_id')) {
foreach ($request->radiology_test_id as $key => $testId) {
if (!$testId) continue;

RadiologyOrder::create([
'consultation_id'  => $consultation->id,
'radiology_test_id'=> $testId,
'priority'         => $request->radiology_priority[$key] ?? 'Routine',
'instruction'      => $request->radiology_instruction[$key] ?? null,
'status'           => 'Ordered',
]);
}
}

// Procedure Orders
if ($request->filled('procedure_id')) {
foreach ($request->procedure_id as $key => $procedureId) {
if (!$procedureId) continue;

ProcedureOrder::create([
'consultation_id' => $consultation->id,
'procedure_id'    => $procedureId,
'remarks'         => $request->procedure_remarks[$key] ?? null,
'status'          => 'Ordered',
]);
}
}

$visit->update([
'status' => 'Completed'
]);

return redirect()
->route('opd.index')
->with('success', 'Consultation saved successfully.');
}

}