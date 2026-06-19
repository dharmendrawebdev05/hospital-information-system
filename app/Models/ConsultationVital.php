<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationVital extends Model
{
protected $fillable = [
'consultation_id',
'patient_id',

'height',
'weight',
'bmi',

'temperature',
'pulse',
'respiratory_rate',

'blood_pressure',
'spo2',

'head_circumference',
'waist_circumference',

'remarks',
'recorded_by',
];


public function consultation()
{
return $this->belongsTo(Consultation::class);
}

public function patient()
{
return $this->belongsTo(Patient::class);
}





}