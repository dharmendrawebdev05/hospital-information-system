<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $fillable = [
        'ward_id',
        'bed_no',
        'room_no',
        'status',
        'remarks'
    ];

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}