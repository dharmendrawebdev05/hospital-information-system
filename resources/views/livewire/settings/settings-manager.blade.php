<div>

<style>
.nav-tabs .nav-link{
font-weight:600;
color:#6c757d;
}

.nav-tabs .nav-link.active{
background:#007bff;
color:#fff !important;
}

.setting-section{
padding:20px;
}
</style>

<div>


<div class="card card-outline card-primary mt-4">

<div class="card-header">

<div class="d-flex justify-content-between align-items-center">

<h3 class="card-title">
<i class="fas fa-cogs"></i>
Hospital Settings
</h3>

<button
type="button"
wire:click="save"
wire:loading.attr="disabled"
class="btn btn-primary">

<span wire:loading.remove>
<i class="fas fa-save"></i>
Save Settings
</span>

<span wire:loading>
<i class="fas fa-spinner fa-spin"></i>
Saving...
</span>

</button>

</div>

</div>

<div class="card-body">

<ul class="nav nav-tabs">

<li class="nav-item">
<a href="#"
wire:click.prevent="$set('activeTab','hospital')"
class="nav-link {{ $activeTab == 'hospital' ? 'active' : '' }}">
<i class="fas fa-hospital"></i>
Hospital
</a>


</li>

<li class="nav-item">
<a href="#"
wire:click.prevent="$set('activeTab','numbering')"
class="nav-link {{ $activeTab == 'numbering' ? 'active' : '' }}">
<i class="fas fa-hashtag"></i>
Number Series
</a>
</li>

<li class="nav-item">
<a href="#"
wire:click.prevent="$set('activeTab','opd')"
class="nav-link {{ $activeTab == 'opd' ? 'active' : '' }}">
<i class="fas fa-user-md"></i>
OPD
</a>
</li>

<li class="nav-item">
<a href="#"
wire:click.prevent="$set('activeTab','system')"
class="nav-link {{ $activeTab == 'system' ? 'active' : '' }}">
<i class="fas fa-cogs"></i>
System
</a>
</li>

</ul>

{{-- Hospital --}}
@if($activeTab == 'hospital')

<div class="setting-section">

<div class="row">

<div class="col-md-6 mb-3">
<label>Hospital Name</label>
<input type="text"
class="form-control"
wire:model="hospital_name">
</div>

<div class="col-md-6 mb-3">
<label>Hospital Code</label>
<input type="text"
class="form-control"
wire:model="hospital_code">
</div>

<div class="col-md-6 mb-3">

<label>Hospital Logo</label>

<input type="file"
class="form-control"
wire:model="logo"
accept="image/*">

{{-- NEW UPLOAD PREVIEW --}}
@if($logo && is_object($logo))
<img src="{{ $logo->temporaryUrl() }}"
class="img-thumbnail mt-2"
style="height:100px;">
@endif

{{-- SAVED LOGO --}}
@if(!$logo && $logo_path)
<img src="{{ asset('storage/'.$logo_path) }}"
class="img-thumbnail mt-2"
style="height:100px;">
@endif

</div>


<div class="col-md-6 mb-3">
<label>Mobile Number</label>
<input type="text"
class="form-control"
wire:model="mobile">
</div>

<div class="col-md-6 mb-3">
<label>Email</label>
<input type="email"
class="form-control"
wire:model="email">
</div>

<div class="col-md-6 mb-3">
<label>Address</label>
<textarea class="form-control"
rows="3"
wire:model="address"></textarea>
</div>

</div>

</div>

@endif

{{-- Number Series --}}
@if($activeTab == 'numbering')

<div class="setting-section">

<div class="row">

<div class="col-md-3">
<label>UHID Prefix</label>
<input type="text"
class="form-control"
wire:model="uhid_prefix">
</div>

<div class="col-md-3">
<label>OPD Prefix</label>
<input type="text"
class="form-control"
wire:model="opd_prefix">
</div>

<div class="col-md-3">
<label>IPD Prefix</label>
<input type="text"
class="form-control"
wire:model="ipd_prefix">
</div>

<div class="col-md-3">
<label>Bill Prefix</label>
<input type="text"
class="form-control"
wire:model="bill_prefix">
</div>

</div>

</div>

@endif

{{-- OPD --}}
@if($activeTab == 'opd')

<div class="setting-section">

<div class="row">

<div class="col-md-4">

<label>Followup Days</label>

<input type="number"
class="form-control"
wire:model="followup_days">

</div>

</div>

</div>

@endif

{{-- System --}}
@if($activeTab == 'system')

<div class="setting-section">

<div class="row">

<div class="col-md-3">

<div class="custom-control custom-switch">

<input type="checkbox"
id="sms_enabled"
class="custom-control-input"
wire:model="sms_enabled">

<label class="custom-control-label"
for="sms_enabled">
SMS Enabled
</label>

</div>

</div>

<div class="col-md-3">

<div class="custom-control custom-switch">

<input type="checkbox"
id="whatsapp_enabled"
class="custom-control-input"
wire:model="whatsapp_enabled">

<label class="custom-control-label"
for="whatsapp_enabled">
WhatsApp Enabled
</label>

</div>

</div>

<div class="col-md-3">

<div class="custom-control custom-switch">

<input type="checkbox"
id="token_auto_generate"
class="custom-control-input"
wire:model="token_auto_generate">

<label class="custom-control-label"
for="token_auto_generate">
Auto Token Generate
</label>

</div>

</div>

<div class="col-md-3">

<div class="custom-control custom-switch">

<input type="checkbox"
id="deposit_mandatory"
class="custom-control-input"
wire:model="deposit_mandatory">

<label class="custom-control-label"
for="deposit_mandatory">
IPD Deposit Mandatory
</label>

</div>

</div>

</div>

</div>

@endif

</div>

</div>


</div>

</div>

@script
<script>

$wire.on('settings-saved', () => {

$(document).Toasts('create', {

class: 'bg-gradient-success',

title: 'Success',

icon: 'fas fa-check-circle',

autohide: true,

delay: 5000,

body: 'Settings updated successfully.'

});

});

</script>
@endscript


