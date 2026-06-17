<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('lab_orders', function (Blueprint $table) {

$table->id();

$table->foreignId('consultation_id')
->constrained()
->cascadeOnDelete();

$table->foreignId('patient_id')
->constrained()
->cascadeOnDelete();

$table->foreignId('doctor_id')
->nullable()
->constrained()
->nullOnDelete();

$table->foreignId('lab_test_id')
->constrained()
->cascadeOnDelete();

// Order Details
$table->enum('priority', [
'Routine',
'Urgent',
'Stat'
])->default('Routine');

$table->text('instruction')->nullable();

// Workflow
$table->enum('status', [
'Ordered',
'Sample Collected',
'In Process',
'Reported',
'Cancelled'
])->default('Ordered');

// Dates
$table->timestamp('ordered_at')->nullable();
$table->timestamp('sample_collected_at')->nullable();
$table->timestamp('reported_at')->nullable();

$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('lab_orders');
}
};