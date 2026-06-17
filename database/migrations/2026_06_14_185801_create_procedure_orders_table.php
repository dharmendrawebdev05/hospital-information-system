<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('procedure_orders', function (Blueprint $table) {

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

$table->foreignId('procedure_id')
->constrained()
->cascadeOnDelete();

// Workflow
$table->enum('status', [
'Ordered',
'Scheduled',
'In Progress',
'Completed',
'Cancelled'
])->default('Ordered');

// Scheduling
$table->date('procedure_date')->nullable();
$table->time('procedure_time')->nullable();

// Clinical Notes
$table->text('remarks')->nullable();
$table->text('findings')->nullable();

// Billing
$table->decimal('cost', 10, 2)->default(0);

$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('procedure_orders');
}
};