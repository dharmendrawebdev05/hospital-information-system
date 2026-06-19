<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcedureOrder extends Model
{


protected $fillable = [
'consultation_id',	

'procedure_id',

'procedure_date',

'procedure_time',

'source',

'status',      // Ordered, In Progress, Completed, Cancelled

'remarks'

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
