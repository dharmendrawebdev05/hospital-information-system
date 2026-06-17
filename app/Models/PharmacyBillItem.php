<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyBillItem extends Model
{
protected $fillable = [
'pharmacy_bill_id',

'medicine_id',

'batch_no',

'qty',
'rate',

'discount_amount',
'tax_amount',

'amount',

'remarks',
];

public function bill()
{
return $this->belongsTo(PharmacyBill::class);
}

public function medicine()
{
return $this->belongsTo(Medicine::class);
}


}