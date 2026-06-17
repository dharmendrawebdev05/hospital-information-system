<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
use HasFactory;

protected $fillable = [
'opd_visit_id',
'ipd_admission_id',

'patient_id',
'doctor_id',

'medicine_id',

'dosage',
'frequency',
'duration',

'instruction',

'route',

'status',
];



/*
|-----------------------------
| RELATIONSHIPS
|-----------------------------
*/

public function patient()
{
return $this->belongsTo(Patient::class);
}

public function doctor()
{
return $this->belongsTo(Doctor::class);
}

public function medicine()
{
return $this->belongsTo(Medicine::class);
}

public function opdVisit()
{
return $this->belongsTo(OpdVisit::class);
}

public function ipdAdmission()
{
return $this->belongsTo(IpdAdmission::class);
}




}