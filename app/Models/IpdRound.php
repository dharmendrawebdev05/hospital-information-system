<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpdRound extends Model
{
    protected $fillable = [
        'admission_id',
        'doctor_id',
        'round_time',
        'chief_complaint',
        'clinical_notes',
        'diagnosis',
        'treatment_plan',
        'doctor_orders'
    ];

    protected $casts = [
        'round_time' => 'datetime',
    ];

    public function admission()
    {
        return $this->belongsTo(IpdAdmission::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}