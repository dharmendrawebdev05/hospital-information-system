<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
    'appointment_no',
    'token_no',
    'patient_id',
    'doctor_id',
    'appointment_date',
    'appointment_time',
    'consultation_fee',
    'appointment_type',
    'visit_type',
    'reference_by',
    'remarks',
    'status',
];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}