<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadiologyOrder extends Model
{
protected $fillable = [
'patient_id',

'opd_visit_id',
'ipd_admission_id',

'doctor_id',

'radiology_test_id',

'order_date',

'status',      // Ordered, Scheduled, Completed, Cancelled

'report',

'remarks',
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
