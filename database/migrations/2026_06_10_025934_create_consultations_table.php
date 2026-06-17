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
Schema::create('consultations', function (Blueprint $table) {

$table->id();

$table->foreignId('patient_id')
->constrained()
->cascadeOnDelete();

$table->foreignId('doctor_id')
->constrained()
->cascadeOnDelete();

// Context
$table->foreignId('opd_visit_id')
->nullable()
->constrained()
->nullOnDelete();

$table->foreignId('ipd_admission_id')
->nullable()
->constrained()
->nullOnDelete();

$table->enum('source', [
'OPD',
'IPD',
'Emergency'
]);

// Clinical
$table->text('chief_complaint')->nullable();
$table->longText('history')->nullable();
$table->longText('clinical_examination')->nullable();
$table->longText('diagnosis')->nullable();
$table->longText('advice')->nullable();

// Follow-up / Outcome
$table->date('followup_date')->nullable();

$table->enum('visit_status', [
'Completed',
'Followup',
'Admit',
'Referred'
])->default('Completed');

// IPD Round Notes
$table->text('progress_notes')->nullable();

$table->timestamps();
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('consultations');
}
};
