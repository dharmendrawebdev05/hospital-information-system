<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Diet;
use Illuminate\Database\Seeder;


class DietSeeder extends Seeder
{
public function run(): void
{
$diets = [

// Normal
['Normal Diet', 'Normal'],
['Regular Diet', 'Normal'],

// Liquid
['Clear Liquid Diet', 'Liquid'],
['Full Liquid Diet', 'Liquid'],

// Soft
['Soft Diet', 'Soft'],
['Semi Solid Diet', 'Soft'],
['Bland Diet', 'Soft'],

// Diabetic
['Diabetic Diet', 'Diabetic'],
['Low Sugar Diet', 'Diabetic'],

// Cardiac
['Cardiac Diet', 'Cardiac'],
['Low Cholesterol Diet', 'Cardiac'],

// Renal
['Renal Diet', 'Renal'],
['Low Potassium Diet', 'Renal'],

// High Protein
['High Protein Diet', 'High Protein'],
['Post Operative High Protein Diet', 'High Protein'],

// Low Salt
['Low Salt Diet', 'Low Salt'],
['Hypertension Diet', 'Low Salt'],

// Low Fat
['Low Fat Diet', 'Low Fat'],
['Gall Bladder Diet', 'Low Fat'],

// Therapeutic
['Post Surgery Diet', 'Therapeutic'],
['Tube Feeding Diet', 'Therapeutic'],
['Liver Disease Diet', 'Therapeutic'],
['Pancreatitis Diet', 'Therapeutic'],

// Pediatric
['Pediatric Diet', 'Pediatric'],
['Infant Feeding Diet', 'Pediatric'],

// Pregnancy
['Pregnancy Diet', 'Obstetric'],
['Lactating Mother Diet', 'Obstetric'],

];

$counter = 1;

foreach ($diets as $diet) {

Diet::firstOrCreate(

['diet_name' => $diet[0]],

[
'diet_code' => 'DIET' . str_pad($counter, 4, '0', STR_PAD_LEFT),

'category' => $diet[1],

'description' => $diet[0],

'status' => 'Active',
]
);

$counter++;
}
}
}
