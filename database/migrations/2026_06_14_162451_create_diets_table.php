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
       
    Schema::create('diets', function (Blueprint $table) {

    $table->id();

    $table->string('diet_code')->unique();

    $table->string('diet_name');

    $table->string('category')->nullable();

    $table->text('description')->nullable();

    $table->enum('status', ['Active', 'Inactive'])
    ->default('Active');

    $table->timestamps();
    });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diets');
    }
};
