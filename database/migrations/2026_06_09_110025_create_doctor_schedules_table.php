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
    
     Schema::create('doctor_schedules', function (Blueprint $table) {
    $table->id();

    $table->foreignId('doctor_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('day_name'); // Monday, Tuesday

    $table->boolean('status')->default(true);

    $table->timestamps();

    $table->unique(['doctor_id', 'day_name']);
}); 


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
