<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
public function run(): void
{
$departments = [
[
'name' => 'General Medicine',
'code' => 'GMED',
'description' => 'General OPD and internal medicine services'
],
[
'name' => 'General Surgery',
'code' => 'GSUR',
'description' => 'Surgical department'
],
[
'name' => 'Orthopedics',
'code' => 'ORTHO',
'description' => 'Bone and joint related treatments'
],
[
'name' => 'Cardiology',
'code' => 'CARD',
'description' => 'Heart related treatments'
],
[
'name' => 'Neurology',
'code' => 'NEUR',
'description' => 'Brain and nerve system'
],
[
'name' => 'Pediatrics',
'code' => 'PED',
'description' => 'Child healthcare department'
],
[
'name' => 'Gynecology & Obstetrics',
'code' => 'GYN',
'description' => 'Women health and maternity'
],
[
'name' => 'ENT',
'code' => 'ENT',
'description' => 'Ear Nose Throat department'
],
[
'name' => 'Ophthalmology',
'code' => 'EYE',
'description' => 'Eye care department'
],
[
'name' => 'Dermatology',
'code' => 'DERM',
'description' => 'Skin related treatments'
],
[
'name' => 'Psychiatry',
'code' => 'PSY',
'description' => 'Mental health department'
],
[
'name' => 'Radiology',
'code' => 'RAD',
'description' => 'X-Ray, CT Scan, MRI services'
],
[
'name' => 'Pathology / Lab',
'code' => 'LAB',
'description' => 'Lab tests and diagnostics'
],
[
'name' => 'Emergency',
'code' => 'EMG',
'description' => 'Emergency and trauma care'
],
[
'name' => 'ICU',
'code' => 'ICU',
'description' => 'Critical care unit'
],
[
'name' => 'Pharmacy',
'code' => 'PHR',
'description' => 'Medicine dispensing unit'
],
[
'name' => 'Operation Theatre',
'code' => 'OT',
'description' => 'Surgical operation theatre'
],
];

foreach ($departments as $dept) {
Department::updateOrCreate(
['code' => $dept['code']],
$dept
);
}
}
}