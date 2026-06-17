<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Procedure;

class ProcedureSeeder extends Seeder
{
public function run(): void
{
$departments = Department::pluck('id', 'name');

$procedures = [

// ================= DIAGNOSTIC =================

['ECG', 'Cardiology', 'Diagnostic'],
['2D Echo', 'Cardiology', 'Diagnostic'],
['TMT', 'Cardiology', 'Diagnostic'],
['X-Ray Chest', 'Radiology', 'Diagnostic'],
['X-Ray Limb', 'Radiology', 'Diagnostic'],
['Ultrasound Abdomen', 'Radiology', 'Diagnostic'],
['USG Pelvis', 'Radiology', 'Diagnostic'],
['CT Brain', 'Radiology', 'Diagnostic'],
['CT Abdomen', 'Radiology', 'Diagnostic'],
['MRI Brain', 'Radiology', 'Diagnostic'],
['MRI Spine', 'Radiology', 'Diagnostic'],
['Endoscopy', 'Gastroenterology', 'Diagnostic'],
['Colonoscopy', 'Gastroenterology', 'Diagnostic'],
['Bronchoscopy', 'Pulmonology', 'Diagnostic'],
['EEG', 'Neurology', 'Diagnostic'],

// ================= THERAPEUTIC =================

['Nebulization', 'Pulmonology', 'Therapeutic'],
['Dialysis', 'Nephrology', 'Therapeutic'],
['Blood Transfusion', 'General Surgery', 'Therapeutic'],
['Chemotherapy Session', 'Oncology', 'Therapeutic'],
['Physiotherapy Session', 'Physiotherapy', 'Therapeutic'],
['Oxygen Therapy', 'Pulmonology', 'Therapeutic'],
['IV Fluid Therapy', 'General Surgery', 'Therapeutic'],
['Wound Care', 'General Surgery', 'Therapeutic'],
['Pain Management Injection', 'Orthopedics', 'Therapeutic'],
['Cardiac Rehabilitation', 'Cardiology', 'Therapeutic'],

// ================= MINOR =================

['Dressing', 'General Surgery', 'Minor'],
['Suturing', 'General Surgery', 'Minor'],
['Abscess Drainage', 'General Surgery', 'Minor'],
['Nail Removal', 'General Surgery', 'Minor'],
['Foreign Body Removal', 'ENT', 'Minor'],
['Ear Syringing', 'ENT', 'Minor'],
['Catheterization', 'Urology', 'Minor'],
['Ryle\'s Tube Insertion', 'General Surgery', 'Minor'],
['Cannulation', 'General Surgery', 'Minor'],
['Biopsy Skin', 'Dermatology', 'Minor'],
['Incision & Drainage', 'General Surgery', 'Minor'],
['Wart Removal', 'Dermatology', 'Minor'],
['Corn Removal', 'Dermatology', 'Minor'],
['Bandaging', 'Orthopedics', 'Minor'],
['Vaccination', 'General Medicine', 'Minor'],

// ================= MAJOR =================

['Appendectomy', 'General Surgery', 'Major'],
['Cholecystectomy', 'General Surgery', 'Major'],
['Hernia Repair', 'General Surgery', 'Major'],
['Thyroidectomy', 'General Surgery', 'Major'],
['Mastectomy', 'General Surgery', 'Major'],
['Colectomy', 'General Surgery', 'Major'],
['Gastrectomy', 'General Surgery', 'Major'],
['Nephrectomy', 'Urology', 'Major'],
['Hysterectomy', 'Gynecology', 'Major'],
['Myomectomy', 'Gynecology', 'Major'],
['Splenectomy', 'General Surgery', 'Major'],
['Lobectomy', 'General Surgery', 'Major'],
['Craniotomy', 'Neurosurgery', 'Major'],
['Spinal Fusion', 'Orthopedics', 'Major'],
['Prostatectomy', 'Urology', 'Major'],

// ================= SURGICAL =================

['Cataract Surgery', 'Ophthalmology', 'Surgical'],
['Cesarean Section', 'Gynecology', 'Surgical'],
['CABG', 'Cardiology', 'Surgical'],
['Valve Replacement', 'Cardiology', 'Surgical'],
['Angioplasty', 'Cardiology', 'Surgical'],
['Total Knee Replacement', 'Orthopedics', 'Surgical'],
['Total Hip Replacement', 'Orthopedics', 'Surgical'],
['Arthroscopy', 'Orthopedics', 'Surgical'],
['PCNL', 'Urology', 'Surgical'],
['TURP', 'Urology', 'Surgical'],
['Ureteroscopy', 'Urology', 'Surgical'],
['Retinal Surgery', 'Ophthalmology', 'Surgical'],
['Tonsillectomy', 'ENT', 'Surgical'],
['Septoplasty', 'ENT', 'Surgical'],
['Hemorrhoidectomy', 'General Surgery', 'Surgical'],
];

$counter = 1;


foreach ($procedures as $procedure) {

Procedure::firstOrCreate(

['procedure_name' => $procedure[0]],

[
'procedure_code' => 'PROC' . str_pad($counter, 4, '0', STR_PAD_LEFT),

'department_id' => $departments[$procedure[1]] ?? null,

'category' => $procedure[2],

'charges' => 0,

'status' => 'Active',
]
);

$counter++;
}
}
}






