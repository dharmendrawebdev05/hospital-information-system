<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
public function run(): void
{
Setting::firstOrCreate(
['id' => 1],
[

'hospital_name' => 'My Hospital',
'hospital_code' => 'HOSP',

'mobile' => '',
'email' => '',
'address' => '',

'gst_no' => '',

'uhid_prefix' => 'UHID',
'opd_prefix' => 'OPD',
'ipd_prefix' => 'IPD',
'bill_prefix' => 'BILL',

'bill_footer' =>
'Thank you for visiting.',

'prescription_footer' =>
'Follow doctor instructions carefully.',

'sms_enabled' => 0,
'whatsapp_enabled' => 0,

'token_auto_generate' => 1,
'followup_days' => 7,
'deposit_mandatory' => 0,

]
);
}
}