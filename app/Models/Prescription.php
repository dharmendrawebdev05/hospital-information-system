<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
use HasFactory;

protected $fillable = [
    'consultation_id',
    'medicine_id',

    'dosage',
    'route',
    'frequency',
    'days',
    'quantity',

    'instruction',

    'status',
];



/*
|-----------------------------
| RELATIONSHIPS
|-----------------------------
*/

public function patient()
{
return $this->belongsTo(Patient::class);
}

public function doctor()
{
return $this->belongsTo(Doctor::class);
}

public function medicine()
{
return $this->belongsTo(Medicine::class);
}

public function opdVisit()
{
return $this->belongsTo(OpdVisit::class);
}





}