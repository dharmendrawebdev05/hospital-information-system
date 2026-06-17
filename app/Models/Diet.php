<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    protected $fillable = [

        'diet_code',
        'diet_name',
        'category',
        'description',
        'status'

    ];
}