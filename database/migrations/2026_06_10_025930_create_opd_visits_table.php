<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
* Run the migrations.
*/
public function up()
{

Schema::create('opd_visits', function (Blueprint $table) {

$table->id();

$table->string('visit_no')->unique();

$table->foreignId('appointment_id')
->nullable()
->constrained()
->nullOnDelete();

$table->foreignId('patient_id')
->constrained()
->cascadeOnDelete();

$table->foreignId('doctor_id')
->constrained()
->cascadeOnDelete();

$table->dateTime('visited_at');

$table->integer('token_no')->nullable();

$table->enum('visit_type', [
'New',
'Followup'
])->default('New');

$table->enum('status', [
'Waiting',
'In Queue',
'In Consultation',
'Completed',
'Cancelled'
])->default('Waiting');

$table->text('notes')->nullable();

$table->timestamps();

$table->index(['doctor_id', 'visited_at']);
$table->index(['patient_id']);
});   


}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('opd_visits');
}
};
