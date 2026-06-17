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
      
Schema::create('doctor_schedule_sessions', function (Blueprint $table) {

$table->id();

$table->foreignId('doctor_schedule_id')
->constrained()
->cascadeOnDelete();

$table->string('session_name');

$table->time('start_time');

$table->time('end_time');

$table->integer('slot_duration')
->default(20);

$table->integer('max_patients')
->default(50);

$table->boolean('is_active')
->default(true);

$table->timestamps();
});    

      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedule_sessions');
    }
};
