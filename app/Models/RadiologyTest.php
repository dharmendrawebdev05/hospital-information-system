<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadiologyTest extends Model
{
   protected $fillable = [
    'test_code',
    'test_name',
    'modality',
    'price',
    'is_active'
];
}
