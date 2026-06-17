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

Schema::create('patient_bill_items', function (Blueprint $table) {

$table->id();

$table->foreignId('patient_bill_id')
->constrained()
->cascadeOnDelete();

$table->string('service_type');

$table->unsignedBigInteger('service_id');

$table->string('service_name');

$table->decimal('qty',10,2)->default(1);

$table->decimal('rate',10,2);

$table->decimal('amount',10,2);

$table->timestamps();
});     



}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('patient_bill_items');
}
};
