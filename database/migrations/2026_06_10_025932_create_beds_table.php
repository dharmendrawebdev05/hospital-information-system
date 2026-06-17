<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
Schema::create('beds', function (Blueprint $table) {

$table->id();

$table->foreignId('ward_id')
->constrained()
->cascadeOnDelete();

$table->string('bed_no');

$table->string('room_no')->nullable();

$table->enum('status', [
'Available',
'Occupied',
'Maintenance'
])->default('Available');

$table->text('remarks')->nullable();

$table->timestamps();

$table->unique(['ward_id','bed_no']);
});
}

public function down(): void
{
Schema::dropIfExists('beds');
}
};