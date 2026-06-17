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
        Schema::create('lab_results', function (Blueprint $table) {
    $table->id();

    $table->foreignId('lab_order_id')->constrained()->onDelete('cascade');

    $table->string('parameter');        // Hb, WBC, Sugar etc
    $table->string('result');           // value
    $table->string('unit')->nullable(); // g/dl, mg/dl
    $table->string('normal_range')->nullable();
    $table->text('remarks')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_results');
    }
};
