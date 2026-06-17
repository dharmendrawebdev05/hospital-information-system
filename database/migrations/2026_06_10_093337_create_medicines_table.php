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
        Schema::create('medicines', function (Blueprint $table) {
        $table->id();

        $table->string('medicine_name')->nullable();
        $table->string('generic_name')->nullable();
        $table->string('strength')->nullable();
        $table->string('unit')->nullable();

        $table->decimal('purchase_price',10,2)->default(0);
        $table->decimal('selling_price',10,2)->default(0);

        $table->integer('stock_qty')->default(0);

        $table->integer('reorder_level')->default(10);
        $table->string('batch_no')->nullable();
        $table->date('expiry_date')->nullable();

        $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
