<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ward;
use App\Models\Bed;

class BedSeeder extends Seeder
{
    public function run(): void
    {
        $wards = Ward::all();

        foreach ($wards as $ward) {

            for ($i = 1; $i <= $ward->total_beds; $i++) {

                $bedNo = strtoupper(substr(str_replace(' ', '', $ward->ward_type), 0, 3))
                    . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);

                // 2 beds per room
                $roomNo = 'R-' . str_pad(ceil($i / 2), 3, '0', STR_PAD_LEFT);

                Bed::updateOrCreate(
                    [
                        'ward_id' => $ward->id,
                        'bed_no'  => $bedNo,
                    ],
                    [
                        'room_no' => $roomNo,
                        'status'  => 'Available',
                        'remarks' => null,
                    ]
                );
            }
        }
    }
}