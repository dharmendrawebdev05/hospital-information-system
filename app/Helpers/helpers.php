<?php

use App\Models\Setting;

/**
* Get single settings row (cached in runtime)
*/
function setting()
{
return cache()->remember('hospital_setting', 3600, function () {
return Setting::first();
});
}

/**
* Hospital name shortcut
*/
function hospital_name()
{
return setting()?->hospital_name ?? 'Hospital OS';
}

/**
* Hospital logo URL
*/
function hospital_logo()
{
$setting = setting();

return $setting && $setting->logo
? asset('storage/' . $setting->logo)
: asset('vendor/adminlte/dist/img/AdminLTELogo.png');
}

/**
* Print header text
*/
function print_header()
{
return setting()?->print_header_text ?? hospital_name();
}

/**
* Currency format helper
*/
function money($amount)
{
return '₹ ' . number_format((float) ($amount ?? 0), 2);
}