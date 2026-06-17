<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
Schema::create('ipd_admissions', function (Blueprint $table) {

$table->id();

$table->string('admission_no')->unique();

$table->foreignId('opd_visit_id')
->nullable()
->constrained()
->nullOnDelete();

$table->foreignId('patient_id')
->constrained()
->cascadeOnDelete();

// Admitting Doctor
$table->foreignId('doctor_id')
->constrained()
->cascadeOnDelete();

$table->foreignId('bed_id')
->nullable()
->constrained()
->nullOnDelete();

$table->enum('source', [
'OPD',
'Emergency',
'Direct',
'Referral'
])->default('OPD');

// Admission Details
$table->dateTime('admitted_at');

$table->text('reason')->nullable();
$table->text('remarks')->nullable();

// Clinical
$table->string('admission_diagnosis')->nullable();

// Admission Status
$table->enum('status', [
'Admitted',
'Transferred',
'Discharged',
'Expired'
])->default('Admitted');

// Discharge
$table->dateTime('discharged_at')->nullable();

$table->text('discharge_summary')->nullable();

$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('ipd_admissions');
}
};