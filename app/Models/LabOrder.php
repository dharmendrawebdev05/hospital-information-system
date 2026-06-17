<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabOrder extends Model
{
protected $fillable = [
'consultation_id',
'patient_id',
'doctor_id',
'lab_test_id',
'source',
'priority',
'status',
'instruction',
];

public function consultation()
{
return $this->belongsTo(Consultation::class);
}

public function patient()
{
return $this->belongsTo(Patient::class);
}

public function doctor()
{
return $this->belongsTo(Doctor::class);
}

public function labTest()
{
return $this->belongsTo(LabTest::class);
}
}