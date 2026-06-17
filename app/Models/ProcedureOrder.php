<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcedureOrder extends Model
{


protected $fillable = [
'patient_id',
'opd_visit_id',
'ipd_admission_id',

'doctor_id',

'procedure_id',

'order_date',

'status',      // Ordered, In Progress, Completed, Cancelled

'remarks',
'ordered_by',
];



public function consultation()
{
return $this->belongsTo(Consultation::class);
}

public function patient()
{
return $this->belongsTo(Patient::class);
}

public function doctor()
{
return $this->belongsTo(Doctor::class);
}

public function procedure()
{
return $this->belongsTo(Procedure::class);
}
}
