<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{


protected $fillable = [

    'medicine_name',
    'generic_name',
    'strength',
    'unit',
    'purchase_price',
    'selling_price',
    'stock_qty',
    'reorder_level',
    'batch_no',
    'expiry_date',
    'status',

];



    
   public function prescriptions()
{
    return $this->hasMany(Prescription::class);
}

}
