<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
Schema::create('doctor_orders', function (Blueprint $table) {

$table->id();

$table->foreignId('admission_id')
->constrained('ipd_admissions')
->cascadeOnDelete();

$table->foreignId('doctor_id')
->constrained('doctors');

$table->enum('order_type', [
'lab',
'radiology',
'medicine',
'procedure',
'diet'
]);

$table->string('order_name');

$table->text('instructions')->nullable();

$table->enum('status', [
'pending',
'in_progress',
'completed',
'cancelled'
])->default('pending');

$table->dateTime('ordered_at');

$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('doctor_orders');
}
};