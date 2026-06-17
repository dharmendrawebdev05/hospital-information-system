<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Models\Setting;
use Livewire\WithFileUploads;
use Livewire\Attributes\Url;

class SettingsManager extends Component
{
use WithFileUploads;

#[Url]
public $activeTab = 'hospital';

// Hospital Information
public $hospital_name;
public $hospital_code;
public $mobile;
public $email;
public $address;

public $logo;          // NEW upload file
public $logo_path;     // saved DB path

// Number Series
public $uhid_prefix;
public $opd_prefix;
public $ipd_prefix;
public $bill_prefix;

// OPD Settings
public $followup_days;

// System Settings
public $sms_enabled = false;
public $whatsapp_enabled = false;
public $token_auto_generate = true;
public $deposit_mandatory = false;

public function mount()
{
$setting = Setting::first();

if (!$setting) {
$setting = Setting::create([
'hospital_name' => 'My Hospital',
'hospital_code' => 'HOSP001',
'logo' => null,
'mobile' => null,
'email' => null,
'address' => null,

'uhid_prefix' => 'UHID',
'opd_prefix' => 'OPD',
'ipd_prefix' => 'IPD',
'bill_prefix' => 'BILL',

'followup_days' => 7,

'sms_enabled' => 0,
'whatsapp_enabled' => 0,
'token_auto_generate' => 1,
'deposit_mandatory' => 0,
]);
}

$this->hospital_name = $setting->hospital_name;
$this->hospital_code = $setting->hospital_code;
$this->mobile = $setting->mobile;
$this->email = $setting->email;
$this->address = $setting->address;

$this->logo_path = $setting->logo; // ONLY PATH

$this->uhid_prefix = $setting->uhid_prefix;
$this->opd_prefix = $setting->opd_prefix;
$this->ipd_prefix = $setting->ipd_prefix;
$this->bill_prefix = $setting->bill_prefix;

$this->followup_days = $setting->followup_days;

$this->sms_enabled = (bool) $setting->sms_enabled;
$this->whatsapp_enabled = (bool) $setting->whatsapp_enabled;
$this->token_auto_generate = (bool) $setting->token_auto_generate;
$this->deposit_mandatory = (bool) $setting->deposit_mandatory;
}

protected function rules()
{
return [
'hospital_name' => 'required|max:255',
'hospital_code' => 'nullable|max:50',
'mobile' => 'nullable|max:20',
'email' => 'nullable|email',
'address' => 'nullable',

'uhid_prefix' => 'required|max:20',
'opd_prefix' => 'required|max:20',
'ipd_prefix' => 'required|max:20',
'bill_prefix' => 'required|max:20',

'followup_days' => 'required|integer|min:0',
];
}

public function save()
{
$this->validate();

$setting = Setting::first();

// STEP 1: Update normal fields
$setting->update([
'hospital_name' => $this->hospital_name,
'hospital_code' => $this->hospital_code,
'mobile' => $this->mobile,
'email' => $this->email,
'address' => $this->address,

'uhid_prefix' => strtoupper($this->uhid_prefix),
'opd_prefix' => strtoupper($this->opd_prefix),
'ipd_prefix' => strtoupper($this->ipd_prefix),
'bill_prefix' => strtoupper($this->bill_prefix),

'followup_days' => $this->followup_days,

'sms_enabled' => $this->sms_enabled,
'whatsapp_enabled' => $this->whatsapp_enabled,
'token_auto_generate' => $this->token_auto_generate,
'deposit_mandatory' => $this->deposit_mandatory,
]);

// STEP 2: Logo upload fix (IMPORTANT)
if ($this->logo) {

$path = $this->logo->store('hospital-logo', 'public');

$setting->logo = $path;
$setting->save();

$this->logo_path = $path;
}

$setting->save();

$this->dispatch('settings-saved');
}

public function render()
{
return view('livewire.settings.settings-manager');
}
}