<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
use WithoutModelEvents;

/**
* Seed the application's database.
*/
public function run(): void
{
// User::factory(10)->create();

$this->call([
RoleSeeder::class,
DepartmentSeeder::class,
SettingSeeder::class,
RadiologyTestSeeder::class,
ProcedureSeeder::class,
DietSeeder::class,
SuperAdminSeeder::class,
MedicineSeeder::class,
LabTestSeeder::class,
WardSeeder::class,
BedSeeder::class,
PatientSeeder::class,
DoctorSeeder::class,
DoctorScheduleSeeder::class,
DoctorScheduleSessionSeeder::class,
PermissionsSeeder::class,
]);
}
}
