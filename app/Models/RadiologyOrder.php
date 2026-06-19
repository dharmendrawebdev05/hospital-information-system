<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadiologyOrder extends Model
{
protected $fillable = [

'consultation_id',

'doctor_id',

'radiology_test_id',

'source',

'instruction',

'priority',

'status',      // Ordered, Scheduled, Completed, Cancelled

];

public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function doctor()
{
    return $this->belongsTo(Doctor::class);
}

public function test()
{
    return $this->belongsTo(RadiologyTest::class, 'radiology_test_id');
}




}
