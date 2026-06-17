<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
protected $fillable = [
'procedure_code',

'procedure_name',

'department_id',

'category',

'charge',

'description',

'duration',

'is_active',
];

public function department()
{
return $this->belongsTo(Department::class);
}
}
