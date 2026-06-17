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
       
    Schema::create('consultation_vitals', function (Blueprint $table) {

    $table->id();

    $table->foreignId('consultation_id')
        ->constrained()
        ->cascadeOnDelete();

    // Basic Vitals
    $table->string('bp')->nullable();
    $table->integer('pulse')->nullable();
    $table->decimal('temperature', 5, 2)->nullable();

    $table->integer('respiratory_rate')->nullable();
    $table->integer('spo2')->nullable();

    // Anthropometry
    $table->decimal('weight', 8, 2)->nullable();
    $table->decimal('height', 8, 2)->nullable();

    $table->decimal('bmi', 5, 2)->nullable();

    // Additional
    $table->decimal('blood_sugar', 8, 2)->nullable();
    $table->integer('pain_score')->nullable(); // 0-10

    $table->text('remarks')->nullable();

    $table->timestamps();
});   

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_vitals');
    }
};
