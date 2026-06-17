<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientBillItem extends Model
{
    protected $fillable = [
        'patient_bill_id',

        'service_type',     // Consultation, Lab, Pharmacy, Room, Procedure
        'service_id',       // Related service record ID

        'description',

        'qty',
        'rate',

        'discount_amount',
        'tax_amount',

        'amount',

        'remarks',
    ];

    public function bill()
    {
        return $this->belongsTo(PatientBill::class, 'patient_bill_id');
    }
}