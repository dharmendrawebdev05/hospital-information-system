<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DoctorSchedule;
use App\Models\DoctorScheduleSession;


class DoctorScheduleSessionSeeder extends Seeder
{
public function run(): void
{
$schedules = DoctorSchedule::all();

foreach ($schedules as $schedule) {

// Morning Session
DoctorScheduleSession::updateOrCreate(
[
'doctor_schedule_id' => $schedule->id,
'session_name' => 'Morning',
],
[
'start_time' => '09:00:00',
'end_time' => '13:00:00',
'slot_duration' => 20,
'max_patients' => 30,
'is_active' => true,
]
);

// Evening Session
DoctorScheduleSession::updateOrCreate(
[
'doctor_schedule_id' => $schedule->id,
'session_name' => 'Evening',
],
[
'start_time' => '17:00:00',
'end_time' => '20:00:00',
'slot_duration' => 15,
'max_patients' => 20,
'is_active' => true,
]
);
}
}
}