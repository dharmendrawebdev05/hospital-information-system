<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientBill extends Model
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

    'payment_status', // Pending, Partial, Paid

    'remarks',
    'created_by',
];
}