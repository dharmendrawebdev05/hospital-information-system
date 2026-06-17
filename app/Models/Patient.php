<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
//


protected $fillable = [

'uhid',

'patient_name',
'mobile',

'gender',
'age',
'dob',

'blood_group',

'marital_status',
'patient_type',
'occupation',

'emergency_contact',
'email',

'address',
'city',
'state',
'pincode',

'aadhaar_no',

'is_active',
];



public function appointments()
{
return $this->hasMany(Appointment::class);
}

public function prescriptions()
{
return $this->hasMany(Prescription::class);
}   



}
