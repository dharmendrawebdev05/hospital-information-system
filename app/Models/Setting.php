<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
protected $fillable = [
'hospital_name',
'hospital_code',
'mobile',
'email',
'address',
'logo',
'gst_no',

'uhid_prefix',
'opd_prefix',
'ipd_prefix',
'bill_prefix',

'bill_footer',
'prescription_footer',

'sms_enabled',
'whatsapp_enabled',

'token_auto_generate',
'followup_days',
'deposit_mandatory',
];
}