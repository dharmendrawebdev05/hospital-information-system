<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\DoctorSchedule;


class DoctorScheduleSeeder extends Seeder
{
public function run(): void
{
$days = [
'Monday',
'Tuesday',
'Wednesday',
'Thursday',
'Friday',
'Saturday',
'Sunday'
];

$doctors = Doctor::all();

foreach ($doctors as $doctor) {

foreach ($days as $day) {

DoctorSchedule::updateOrCreate(
[
'doctor_id' => $doctor->id,
'day_name'  => $day,
],
[
'status' => true,
]
);
}
}
}
}