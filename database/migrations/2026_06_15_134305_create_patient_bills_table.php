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

Schema::create('patient_bills', function (Blueprint $table) {

$table->id();

$table->string('bill_no')->unique();

$table->foreignId('patient_id')->constrained();

$table->foreignId('consultation_id')
->nullable()
->constrained()
->nullOnDelete();

$table->foreignId('ipd_admission_id')
->nullable()
->constrained()
->nullOnDelete();

$table->decimal('gross_amount',10,2)->default(0);

$table->decimal('discount_amount',10,2)->default(0);

$table->decimal('net_amount',10,2)->default(0);

$table->decimal('paid_amount',10,2)->default(0);

$table->enum('status',[
'Pending',
'Partially Paid',
'Paid',
'Cancelled'
])->default('Pending');

$table->timestamps();
});    



}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('patient_bills');
}
};
