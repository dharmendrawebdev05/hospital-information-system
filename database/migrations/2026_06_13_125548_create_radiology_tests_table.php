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
        Schema::create('radiology_tests', function (Blueprint $table) {

    $table->id();

    $table->string('test_code')->unique();

    $table->string('test_name');

    $table->enum('modality', [
        'X-Ray',
        'Ultrasound',
        'CT Scan',
        'MRI',
        'Mammography',
        'Other'
    ]);

    $table->string('department')
          ->default('Radiology');

    $table->decimal('price',10,2)
          ->default(0);

    $table->integer('reporting_time')
          ->nullable()
          ->comment('Minutes');

    $table->text('preparation_instructions')
          ->nullable();

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
        Schema::dropIfExists('radiology_tests');
    }
};
