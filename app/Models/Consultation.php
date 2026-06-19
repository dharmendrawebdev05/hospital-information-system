<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{

protected $fillable = [

'patient_id',
'doctor_id',

'opd_visit_id',
'ipd_admission_id',

'source',

'chief_complaint',
'history',
'clinical_examination',
'diagnosis',
'advice',

'followup_date',
'visit_status',

'progress_notes',
];


public function vitals()
{
return $this->hasOne(ConsultationVital::class);
}

public function prescriptions()
{
return $this->hasMany(Prescription::class);
}

public function procedures()
{
return $this->hasMany(Procedure::class);
}

public function labOrders()
{
return $this->hasMany(LabOrder::class);
}

public function radiologyOrders()
{
return $this->hasMany(RadiologyOrder::class);
}

public function ProcedureOrders()
{
return $this->hasMany(ProcedureOrder::class);
}

public function vital()
{
    return $this->hasOne(ConsultationVital::class);
}


public function opdVisit()
{
    return $this->belongsTo(OpdVisit::class);
}

}