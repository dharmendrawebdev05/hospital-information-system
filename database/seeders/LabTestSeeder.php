<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LabTest;

class LabTestSeeder extends Seeder
{
public function run(): void
{
$tests = [
['Complete Blood Count (CBC)', 350, 'Blood', 'Measures RBC, WBC, Hemoglobin and Platelets'],
['Blood Sugar Fasting', 150, 'Blood', 'Fasting blood glucose test'],
['Blood Sugar PP', 150, 'Blood', 'Post meal blood glucose test'],
['HbA1c', 500, 'Blood', 'Average blood sugar for last 3 months'],
['Lipid Profile', 800, 'Blood', 'Cholesterol and triglycerides test'],
['Liver Function Test (LFT)', 900, 'Blood', 'Evaluates liver health'],
['Kidney Function Test (KFT)', 850, 'Blood', 'Evaluates kidney function'],
['Thyroid Profile (T3 T4 TSH)', 700, 'Blood', 'Checks thyroid function'],
['TSH', 350, 'Blood', 'Thyroid Stimulating Hormone'],
['Vitamin D', 1200, 'Blood', 'Vitamin D deficiency screening'],
['Vitamin B12', 1000, 'Blood', 'Vitamin B12 level test'],
['Serum Calcium', 300, 'Blood', 'Measures calcium level'],
['Uric Acid', 250, 'Blood', 'Checks uric acid level'],
['Dengue NS1', 900, 'Blood', 'Early dengue infection detection'],
['Dengue IgG IgM', 1200, 'Blood', 'Dengue antibody test'],
['Malaria Parasite', 300, 'Blood', 'Malaria screening'],
['Widal Test', 350, 'Blood', 'Typhoid fever screening'],
['CRP', 450, 'Blood', 'Inflammation marker'],
['ESR', 200, 'Blood', 'Inflammation screening test'],
['Rheumatoid Factor', 600, 'Blood', 'Rheumatoid arthritis screening'],
['HIV I & II', 800, 'Blood', 'HIV screening'],
['HBsAg', 600, 'Blood', 'Hepatitis B screening'],
['HCV', 800, 'Blood', 'Hepatitis C screening'],
['Blood Group', 200, 'Blood', 'ABO and Rh typing'],
['Prothrombin Time (PT/INR)', 500, 'Blood', 'Blood clotting test'],
['D-Dimer', 1500, 'Blood', 'Clotting disorder screening'],
['Troponin I', 1800, 'Blood', 'Heart attack marker'],
['Urine Routine', 150, 'Urine', 'Routine urine examination'],
['Urine Culture', 600, 'Urine', 'Detects urinary tract infection'],
['Pregnancy Test', 250, 'Urine', 'Pregnancy detection test'],
['Stool Routine', 200, 'Stool', 'Routine stool examination'],
['Stool Culture', 700, 'Stool', 'Detects intestinal infections'],
['Sputum AFB', 500, 'Sputum', 'Tuberculosis screening'],
['Semen Analysis', 800, 'Semen', 'Male fertility assessment'],
['COVID-19 RT-PCR', 1200, 'Swab', 'COVID-19 detection test'],
['COVID Antigen Test', 500, 'Swab', 'Rapid COVID screening'],
['Pap Smear', 1000, 'Cervical Sample', 'Cervical cancer screening'],
['Biopsy Histopathology', 2500, 'Tissue', 'Microscopic tissue examination'],
['FNAC', 1500, 'Tissue', 'Fine needle aspiration cytology'],
['Culture & Sensitivity', 1200, 'Sample', 'Identifies infectious organisms'],
];

foreach ($tests as $test) {
LabTest::updateOrCreate(
['test_name' => $test[0]],
[
'price' => $test[1],
'sample_type' => $test[2],
'description' => $test[3],
]
);
}
}
}

