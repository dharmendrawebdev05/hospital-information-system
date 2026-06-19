<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {

$modules = [
    'department',
    'service',
    'medicine',
    'lab_test',
    'radiology',
    'procedure',
    'diet',
    'patient',
    'appointment',
    'doctor',
    'doctor_schedule',
    'opd',
    'lab',
    'billing',
    'user',
    'role',
];

foreach ($modules as $module) {

    Permission::firstOrCreate([
        'name' => "{$module}.view"
    ]);

    Permission::firstOrCreate([
        'name' => "{$module}.create"
    ]);

    Permission::firstOrCreate([
        'name' => "{$module}.edit"
    ]);

    Permission::firstOrCreate([
        'name' => "{$module}.delete"
    ]);
}





        

    }
}