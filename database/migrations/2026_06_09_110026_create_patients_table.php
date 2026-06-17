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

Schema::create('patients', function (Blueprint $table) {

$table->id();

// UHID
$table->string('uhid')->nullable()->unique();

// Basic Information
$table->string('patient_name');
$table->string('mobile', 15);

$table->enum('gender', [
'Male',
'Female',
'Other'
]);

$table->integer('age')->nullable();
$table->date('dob')->nullable();

// Medical Information
$table->string('blood_group')->nullable();

// Personal Information
$table->string('marital_status')->nullable();

$table->string('patient_type')
->default('General');

$table->string('occupation')->nullable();

// Contact Information
$table->string('emergency_contact')
->nullable();

$table->string('email')
->nullable();

$table->text('address')
->nullable();

$table->string('city')
->nullable();

$table->string('state')
->nullable();

$table->string('pincode')
->nullable();

// Identification
$table->string('aadhaar_no')
->nullable();

// Status
$table->boolean('is_active')
->default(true);

$table->timestamps();

// Indexes
$table->index('mobile');
$table->index('patient_name');
$table->index('city');
});

}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('patients');
}
};
