<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'doctor_code',
        'doctor_name',
        'department_id',
        'specialization',
        'qualification',
        'registration_no',
        'mobile',
        'email',
        'consultation_fee',
        'followup_fee',
        'status',
    ];


    public function admission()
    {
        return $this->belongsTo(IpdAdmission::class);
    }


     public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }


}
