<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RadiologyTest;

class RadiologyTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
{
    $tests = [

        [
            'test_code' => 'XR001',
            'test_name' => 'Chest PA View',
            'modality' => 'X-Ray',
            'price' => 500,
            
            'is_active' => true,
        ],

        [
            'test_code' => 'XR002',
            'test_name' => 'X-Ray Knee AP/Lateral',
            'modality' => 'X-Ray',
            'price' => 600,
           
            'is_active' => true,
        ],

        [
            'test_code' => 'USG001',
            'test_name' => 'USG Whole Abdomen',
            'modality' => 'Ultrasound',
            'price' => 1200,
           
            'is_active' => true,
        ],

        [
            'test_code' => 'CT001',
            'test_name' => 'CT Brain Plain',
            'modality' => 'CT Scan',
            'price' => 2500,
            
            'is_active' => true,
        ],

        [
            'test_code' => 'MRI001',
            'test_name' => 'MRI Brain',
            'modality' => 'MRI',
            'price' => 4500,
            
            'is_active' => true,
        ],

        [
            'test_code' => 'MAM001',
            'test_name' => 'Mammography Bilateral',
            'modality' => 'Mammography',
            'price' => 1800,
            
            'is_active' => true,
        ],

    ];

    foreach ($tests as $test) {
        RadiologyTest::firstOrCreate(
            ['test_code' => $test['test_code']],
            $test
        );
    }
}
}
