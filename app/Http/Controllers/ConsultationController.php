<?php

namespace App\Http\Controllers;

use App\Models\OpdVisit;
use App\Models\Consultation;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\LabOrder;
use App\Models\LabTest;
use App\Models\ProcedureOrder;

class ConsultationController extends Controller
{

public function store(Request $request, $visitId)
{
$visit = OpdVisit::findOrFail($visitId);

// ================= CONSULTATION SAVE =================
$consultation = Consultation::create([
'opd_visit_id'         => $visit->id,
'chief_complaint'      => $request->chief_complaint,
'history'              => $request->history,
'bp'                   => $request->bp,
'pulse'                => $request->pulse,
'temp'                 => $request->temp,
'weight'              => $request->weight,
'height'              => $request->height,
'spo2'                => $request->spo2,
'clinical_examination'=> $request->clinical_examination,
'diagnosis'            => $request->diagnosis,
'advice'              => $request->advice,
'followup_date'       => $request->followup_date,
'visit_status'        => $request->visit_status ?? 'Completed',
]);

// ================= PRESCRIPTION =================
if ($request->medicine_id) {
foreach ($request->medicine_id as $key => $medicineId) {
if ($medicineId) {
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
}

// ================= LAB ORDERS =================
if ($request->lab_test_id) {
foreach ($request->lab_test_id as $key => $testId) {
if ($testId) {
LabOrder::create([
'consultation_id' => $consultation->id,
'patient_id'      => $visit->patient_id,
'doctor_id'       => $visit->doctor_id,
'lab_test_id'     => $testId,
'source'          => 'OPD',
'priority'        => $request->lab_priority[$key] ?? 'Routine',
'instruction'     => $request->lab_instruction[$key] ?? null,
'status'          => 'Pending',
]);
}
}
}

// ================= RADIOLOGY ORDERS =================
if ($request->radiology_test_id) {
foreach ($request->radiology_test_id as $key => $testId) {
if ($testId) {
RadiologyOrder::create([
'consultation_id' => $consultation->id,
'patient_id'      => $visit->patient_id,
'doctor_id'       => $visit->doctor_id,
'radiology_test_id'=> $testId,
'source'          => 'OPD',
'priority'        => $request->radiology_priority[$key] ?? 'Routine',
'instruction'     => $request->radiology_instruction[$key] ?? null,
'status'          => 'Pending',
]);
}
}
}

// ================= PROCEDURE ORDERS =================
if ($request->procedure_id) {
foreach ($request->procedure_id as $key => $procedureId) {
if ($procedureId) {
ProcedureOrder::create([
'consultation_id' => $consultation->id,
'patient_id'      => $visit->patient_id,
'doctor_id'       => $visit->doctor_id,
'procedure_id'    => $procedureId,
'source'          => 'OPD',
'remarks'         => $request->procedure_remarks[$key] ?? null,
'status'          => 'Pending',
]);
}
}
}

// ================= UPDATE VISIT =================
$visit->update([
'status' => $request->visit_status ?? 'Completed'
]);

return redirect()
->route('opd.index')
->with('success', 'Consultation saved successfully.');
}

}