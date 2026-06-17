<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Consultation;
use App\Models\PharmacyBill;

class OpdVisit extends Model
{
    protected $fillable = [
        'visit_no',
        'appointment_id',
        'patient_id',
        'doctor_id',
        'visit_date',
        'status',
        'notes'
    ];

public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function doctor()
{
    return $this->belongsTo(Doctor::class);
}

public function appointment()
{
    return $this->belongsTo(Appointment::class);
}

public function consultation()
{
    return $this->hasOne(Consultation::class);
}

public function pharmacyBill()
{
    return $this->hasOne(PharmacyBill::class);
}



}