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
    ];

    public function vitals()
    {
        return $this->hasOne(ConsultationVital::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(PatientPrescription::class);
    }

    public function procedures()
    {
        return $this->hasMany(PatientProcedure::class);
    }

    public function labOrders()
    {
        return $this->hasMany(PatientLabOrder::class);
    }

    public function radiologyOrders()
    {
        return $this->hasMany(PatientRadiologyOrder::class);
    }
}