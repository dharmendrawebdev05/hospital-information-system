<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicine;
class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


$medicines = [
            ['Paracetamol', 'Paracetamol', '500mg', 'Tablet'],
            ['Paracetamol', 'Paracetamol', '650mg', 'Tablet'],
            ['Azithromycin', 'Azithromycin', '250mg', 'Tablet'],
            ['Azithromycin', 'Azithromycin', '500mg', 'Tablet'],
            ['Amoxicillin', 'Amoxicillin', '500mg', 'Capsule'],
            ['Cefixime', 'Cefixime', '200mg', 'Tablet'],
            ['Pantoprazole', 'Pantoprazole', '40mg', 'Tablet'],
            ['Omeprazole', 'Omeprazole', '20mg', 'Capsule'],
            ['Rabeprazole', 'Rabeprazole', '20mg', 'Tablet'],
            ['Cetirizine', 'Cetirizine', '10mg', 'Tablet'],
            ['Levocetirizine', 'Levocetirizine', '5mg', 'Tablet'],
            ['Montelukast', 'Montelukast', '10mg', 'Tablet'],
            ['Fexofenadine', 'Fexofenadine', '120mg', 'Tablet'],
            ['Ibuprofen', 'Ibuprofen', '400mg', 'Tablet'],
            ['Diclofenac', 'Diclofenac', '50mg', 'Tablet'],
            ['Aceclofenac', 'Aceclofenac', '100mg', 'Tablet'],
            ['Metformin', 'Metformin', '500mg', 'Tablet'],
            ['Metformin', 'Metformin', '1000mg', 'Tablet'],
            ['Glimepiride', 'Glimepiride', '2mg', 'Tablet'],
            ['Sitagliptin', 'Sitagliptin', '50mg', 'Tablet'],
            ['Teneligliptin', 'Teneligliptin', '20mg', 'Tablet'],
            ['Amlodipine', 'Amlodipine', '5mg', 'Tablet'],
            ['Telmisartan', 'Telmisartan', '40mg', 'Tablet'],
            ['Losartan', 'Losartan', '50mg', 'Tablet'],
            ['Atenolol', 'Atenolol', '50mg', 'Tablet'],
            ['Metoprolol', 'Metoprolol', '50mg', 'Tablet'],
            ['Atorvastatin', 'Atorvastatin', '10mg', 'Tablet'],
            ['Rosuvastatin', 'Rosuvastatin', '10mg', 'Tablet'],
            ['Aspirin', 'Aspirin', '75mg', 'Tablet'],
            ['Clopidogrel', 'Clopidogrel', '75mg', 'Tablet'],
            ['Vitamin C', 'Ascorbic Acid', '500mg', 'Tablet'],
            ['Vitamin D3', 'Cholecalciferol', '60000 IU', 'Capsule'],
            ['Calcium', 'Calcium Carbonate', '500mg', 'Tablet'],
            ['Iron Folic Acid', 'Ferrous Sulphate', '150mg', 'Tablet'],
            ['Zinc', 'Zinc Sulphate', '50mg', 'Tablet'],
            ['ORS', 'ORS Powder', '21g', 'Sachet'],
            ['Ondansetron', 'Ondansetron', '4mg', 'Tablet'],
            ['Domperidone', 'Domperidone', '10mg', 'Tablet'],
            ['Loperamide', 'Loperamide', '2mg', 'Tablet'],
            ['Lactulose', 'Lactulose', '100ml', 'Syrup'],
            ['Alprazolam', 'Alprazolam', '0.5mg', 'Tablet'],
            ['Clonazepam', 'Clonazepam', '0.5mg', 'Tablet'],
            ['Escitalopram', 'Escitalopram', '10mg', 'Tablet'],
            ['Sertraline', 'Sertraline', '50mg', 'Tablet'],
            ['Gabapentin', 'Gabapentin', '300mg', 'Capsule'],
            ['Pregabalin', 'Pregabalin', '75mg', 'Capsule'],
            ['Tramadol', 'Tramadol', '50mg', 'Tablet'],
            ['Cefuroxime', 'Cefuroxime', '500mg', 'Tablet'],
            ['Doxycycline', 'Doxycycline', '100mg', 'Capsule'],
            ['Levofloxacin', 'Levofloxacin', '500mg', 'Tablet'],
        ];

        foreach ($medicines as $index => $medicine) {

            Medicine::updateOrCreate(
                [
                    'medicine_name' => $medicine[0],
                    'strength'      => $medicine[2],
                ],
                [
                    'generic_name'   => $medicine[1],
                    'strength'       => $medicine[2],
                    'unit'           => $medicine[3],
                    'purchase_price' => rand(5, 150),
                    'selling_price'  => rand(10, 250),
                    'stock_qty'      => rand(100, 1000),
                    'reorder_level'  => 50,
                    'batch_no'       => 'BAT' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                    'expiry_date'    => now()->addMonths(rand(12, 36))->format('Y-m-d'),
                    'status'         => 1,
                ]
            );
        }


    }
}
