<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
* Run the migrations.
*/
public function up(): void
{

Schema::create('prescriptions', function (Blueprint $table) {

$table->id();

$table->foreignId('consultation_id')
->constrained()
->cascadeOnDelete();

$table->foreignId('medicine_id')
->constrained()
->cascadeOnDelete();

// Prescription Details
$table->string('dosage')->nullable();       // 500mg
$table->string('route')->nullable();        // Oral, IV, IM
$table->string('frequency')->nullable();    // OD, BD, TDS
$table->integer('days')->nullable();

$table->decimal('quantity', 8, 2)->nullable();

$table->string('instruction')->nullable();  // After Food

// Workflow
$table->enum('status', [
'Active',
'Stopped',
'Completed'
])->default('Active');

$table->timestamps();
});




}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('prescriptions');
}
};
