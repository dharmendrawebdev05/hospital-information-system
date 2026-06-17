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

Schema::create('doctors', function (Blueprint $table) {

$table->id();

$table->string('doctor_code')->unique();

// Login User Mapping
$table->foreignId('user_id')
->nullable()
->constrained()
->nullOnDelete();

$table->foreignId('department_id')
->constrained()
->cascadeOnDelete();

$table->string('doctor_name');

$table->string('specialization')->nullable();

$table->string('qualification')->nullable();

$table->string('registration_no')->nullable(); // MCI/NMC

$table->string('mobile')->nullable();

$table->string('email')->nullable();

$table->text('address')->nullable();

$table->decimal('consultation_fee',10,2)
->default(0);

$table->decimal('followup_fee',10,2)
->default(0);

$table->string('signature')->nullable();

$table->string('photo')->nullable();

$table->boolean('status')->default(true);

$table->timestamps();

$table->index('doctor_name');
$table->index('doctor_code');
});       



}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('doctors');
}
};
