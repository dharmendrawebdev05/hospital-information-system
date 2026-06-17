<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
Schema::create('wards', function (Blueprint $table) {

$table->id();

$table->string('ward_name');

$table->enum('ward_type', [
'General',
'Semi Private',
'Private',
'ICU',
'NICU',
'PICU'
]);

$table->integer('floor_no')->default(1);

$table->integer('total_beds')->default(0);

$table->boolean('is_active')->default(true);

$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('wards');
}
};