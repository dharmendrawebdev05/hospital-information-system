<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpdAdmission extends Model
{
    protected $fillable = [

        'admission_no',

        'opd_visit_id',

        'patient_id',

        'doctor_id',

        'bed_id',

        'source',

        'admission_date',

        'admission_time',

        'reason',

        'remarks',

        'status',

        'discharge_date',

        'discharge_time',
    ];

    protected $casts = [
        'admission_date' => 'date',
        'discharge_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function ward()
    {
    return $this->belongsTo(Ward::class);
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function opdVisit()
    {
        return $this->belongsTo(OpdVisit::class);
    }

    public function vitals()
    {
    return $this->hasMany(IpdVital::class,'admission_id');
    }

    public function rounds()
    {
    return $this->hasMany(IpdRound::class);
    }

    public function doctorOrders()
{
    return $this->hasMany(DoctorOrder::class,'admission_id');
}



}