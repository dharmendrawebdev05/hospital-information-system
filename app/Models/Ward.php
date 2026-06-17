<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = [
        'ward_name',
        'ward_type',
        'floor_no',
        'total_beds',
        'is_active'
    ];

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}