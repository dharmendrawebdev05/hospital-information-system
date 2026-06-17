<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyBill extends Model
{
protected $fillable = [
'bill_no',

'patient_id',
'opd_visit_id',
'ipd_admission_id',

'bill_date',

'gross_amount',
'discount_amount',
'tax_amount',
'net_amount',

'paid_amount',
'balance_amount',

'payment_mode',
'payment_status',

'remarks',
'created_by',
];


public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function items()
{
    return $this->hasMany(PharmacyBillItem::class);
}


}

