<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorOrder extends Model
{
    protected $fillable = [
        'admission_id',
        'doctor_id',
        'order_type',
        'order_name',
        'instructions',
        'status',
        'ordered_at'
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
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