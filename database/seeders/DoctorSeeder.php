<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Department;


class DoctorSeeder extends Seeder
{
public function run(): void
{
$doctors = [
[
'doctor_name' => 'Dr. Rajesh Kumar',
'specialization' => 'Cardiologist',
'qualification' => 'MBBS, MD Cardiology',
],
[
'doctor_name' => 'Dr. Priya Sharma',
'specialization' => 'Gynecologist',
'qualification' => 'MBBS, MS Obstetrics & Gynecology',
],
[
'doctor_name' => 'Dr. Amit Verma',
'specialization' => 'Orthopedic Surgeon',
'qualification' => 'MBBS, MS Orthopedics',
],
[
'doctor_name' => 'Dr. Neha Singh',
'specialization' => 'Pediatrician',
'qualification' => 'MBBS, MD Pediatrics',
],
[
'doctor_name' => 'Dr. Vikas Gupta',
'specialization' => 'General Physician',
'qualification' => 'MBBS, MD Medicine',
],
[
'doctor_name' => 'Dr. Anjali Mishra',
'specialization' => 'Dermatologist',
'qualification' => 'MBBS, MD Dermatology',
],
[
'doctor_name' => 'Dr. Sandeep Yadav',
'specialization' => 'Neurologist',
'qualification' => 'MBBS, DM Neurology',
],
[
'doctor_name' => 'Dr. Pooja Agarwal',
'specialization' => 'ENT Specialist',
'qualification' => 'MBBS, MS ENT',
],
[
'doctor_name' => 'Dr. Rohit Srivastava',
'specialization' => 'Ophthalmologist',
'qualification' => 'MBBS, MS Ophthalmology',
],
[
'doctor_name' => 'Dr. Karan Malhotra',
'specialization' => 'Psychiatrist',
'qualification' => 'MBBS, MD Psychiatry',
],
];

$departments = Department::pluck('id')->toArray();

foreach ($doctors as $index => $doctor) {

Doctor::updateOrCreate(
['doctor_code' => 'DOC' . str_pad($index + 1, 4, '0', STR_PAD_LEFT)],
[
'user_id' => null,

'department_id' => !empty($departments)
? $departments[array_rand($departments)]
: 1,

'doctor_name' => $doctor['doctor_name'],

'specialization' => $doctor['specialization'],

'qualification' => $doctor['qualification'],

'registration_no' => 'REG' . rand(10000, 99999),

'mobile' => '98' . rand(10000000, 99999999),

'email' => 'doctor' . ($index + 1) . '@hospital.com',

'address' => 'Hospital Campus, City Branch',

'consultation_fee' => rand(300, 1000),

'followup_fee' => rand(100, 500),

'signature' => null,

'photo' => null,

'status' => true,
]
);
}
}
}

