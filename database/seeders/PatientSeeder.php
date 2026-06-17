<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
class PatientSeeder extends Seeder
{
public function run(): void
{
$patients = [
[
'patient_name' => 'Rahul Sharma',
'gender' => 'Male',
'age' => 32,
'blood_group' => 'B+',
'city' => 'Delhi',
],
[
'patient_name' => 'Priya Verma',
'gender' => 'Female',
'age' => 28,
'blood_group' => 'O+',
'city' => 'Lucknow',
],
[
'patient_name' => 'Amit Kumar',
'gender' => 'Male',
'age' => 45,
'blood_group' => 'A+',
'city' => 'Patna',
],
[
'patient_name' => 'Neha Singh',
'gender' => 'Female',
'age' => 35,
'blood_group' => 'AB+',
'city' => 'Kanpur',
],
[
'patient_name' => 'Rohit Gupta',
'gender' => 'Male',
'age' => 52,
'blood_group' => 'O-',
'city' => 'Jaipur',
],
];

foreach ($patients as $index => $patient) {

Patient::updateOrCreate(
[
'mobile' => '98' . rand(10000000, 99999999),
],
[
'uhid' => 'UHID' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),

'patient_name' => $patient['patient_name'],
'mobile' => '98' . rand(10000000, 99999999),

'gender' => $patient['gender'],
'age' => $patient['age'],

'dob' => now()
->subYears($patient['age'])
->format('Y-m-d'),

'blood_group' => $patient['blood_group'],

'marital_status' => rand(0, 1)
? 'Married'
: 'Unmarried',

'patient_type' => 'General',

'occupation' => 'Private Employee',

'emergency_contact' => '97' . rand(10000000, 99999999),

'email' => strtolower(str_replace(' ', '', $patient['patient_name']))
. '@gmail.com',

'address' => 'Sample Address, ' . $patient['city'],

'city' => $patient['city'],
'state' => 'Uttar Pradesh',

'pincode' => rand(100000, 999999),

'aadhaar_no' => rand(1000, 9999)
. rand(1000, 9999)
. rand(1000, 9999),

'is_active' => true,
]
);
}
}
}

