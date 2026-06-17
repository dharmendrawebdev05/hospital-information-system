<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpdVital extends Model
{
    protected $fillable = [
        'admission_id',
        'recorded_at',
        'temperature',
        'pulse',
        'respiratory_rate',
        'bp_systolic',
        'bp_diastolic',
        'spo2',
        'blood_sugar',
        'weight',
        'remarks',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function admission()
    {
        return $this->belongsTo(IpdAdmission::class,'admission_id');
    }
}