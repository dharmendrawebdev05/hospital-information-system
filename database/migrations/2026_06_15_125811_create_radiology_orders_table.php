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

Schema::create('radiology_orders', function (Blueprint $table) {

$table->id();

$table->foreignId('patient_id')
->constrained();

// OPD Context
$table->foreignId('consultation_id')
->nullable()
->constrained()
->nullOnDelete();

// IPD Context
$table->foreignId('ipd_admission_id')
->nullable()
->constrained()
->nullOnDelete();

$table->foreignId('doctor_id')
->nullable()
->constrained()
->nullOnDelete();

$table->foreignId('radiology_test_id')
->constrained();

$table->enum('source', [
'OPD',
'IPD',
'Emergency'
]);

$table->string('instruction')->nullable();

$table->enum('priority', [
'Routine',
'Urgent'
])->default('Routine');

$table->enum('status', [
'Ordered',
'Scheduled',
'Completed',
'Cancelled'
])->default('Ordered');

$table->timestamps();
});     


}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('radiology_orders');
}
};
