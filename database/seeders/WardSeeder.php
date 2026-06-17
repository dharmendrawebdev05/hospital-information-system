<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ward;


class WardSeeder extends Seeder
{
public function run(): void
{
$wards = [
['General Ward - Male', 'General', 1, 30],
['General Ward - Female', 'General', 1, 30],

['Semi Private Ward A', 'Semi Private', 2, 20],
['Semi Private Ward B', 'Semi Private', 2, 20],

['Private Ward A', 'Private', 3, 10],
['Private Ward B', 'Private', 3, 10],

['ICU - Adult', 'ICU', 1, 12],
['ICU - Cardiac', 'ICU', 1, 8],

['NICU', 'NICU', 1, 15],

['PICU', 'PICU', 1, 10],
];

foreach ($wards as $ward) {
Ward::updateOrCreate(
['ward_name' => $ward[0]],
[
'ward_type' => $ward[1],
'floor_no' => $ward[2],
'total_beds' => $ward[3],
'is_active' => true,
]
);
}
}
}

