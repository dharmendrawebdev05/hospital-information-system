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

  Schema::create('appointments', function (Blueprint $table) {

    $table->id();

    $table->string('appointment_no')->unique();

    $table->foreignId('patient_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->foreignId('doctor_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->date('appointment_date');

    $table->time('appointment_time')->nullable();

    $table->integer('token_no')->nullable();

    $table->decimal('consultation_fee',10,2)->default(0);

    // Appointment Type
    $table->enum('appointment_type', [
        'New',
        'Followup'
    ])->default('New');

    // Visit Mode
    $table->enum('visit_type', [
        'Walk-In',
        'Appointment'
    ])->default('Appointment');

    // Referral
    $table->string('reference_by')->nullable();

    $table->text('remarks')->nullable();

    $table->enum('status', [
        'Booked',
        'Checked In',
        'Consulting',
        'Completed',
        'Cancelled',
        'No Show'
    ])->default('Booked');

    $table->timestamp('checked_in_at')->nullable();

    $table->timestamps();

    $table->index(['doctor_id','appointment_date']);
    $table->index(['patient_id']);
});      
        


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
