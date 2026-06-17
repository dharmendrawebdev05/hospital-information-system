<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
public function index()
{
$setting = Setting::first();

if (!$setting) {
$setting = Setting::create([]);
}

return view('settings.index', compact('setting'));
}

public function update(Request $request)
{
$setting = Setting::first();

$setting->update([

'hospital_name' => $request->hospital_name,
'hospital_code' => $request->hospital_code,

'mobile' => $request->mobile,
'email' => $request->email,
'address' => $request->address,

'uhid_prefix' => $request->uhid_prefix ?: 'UHID',
'opd_prefix'  => $request->opd_prefix ?: 'OPD',
'ipd_prefix'  => $request->ipd_prefix ?: 'IPD',
'bill_prefix' => $request->bill_prefix ?: 'BILL',

'bill_footer' => $request->bill_footer,
'prescription_footer' => $request->prescription_footer,

'sms_enabled' => $request->has('sms_enabled'),
'whatsapp_enabled' => $request->has('whatsapp_enabled'),

'token_auto_generate' => $request->has('token_auto_generate'),
'followup_days' => $request->followup_days ?: 7,
'deposit_mandatory' => $request->has('deposit_mandatory'),
]);

return back()->with('success', 'Settings Updated Successfully');
}



}