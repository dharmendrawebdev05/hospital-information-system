<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorScheduleSession extends Model
{
    protected $fillable = [
        'doctor_schedule_id',
        'session_name',
        'start_time',
        'end_time',
        'slot_duration',
        'max_patients',
        'is_active',
    ];

    public function doctorSchedule()
    {
        return $this->belongsTo(
            DoctorSchedule::class
        );
    }
}