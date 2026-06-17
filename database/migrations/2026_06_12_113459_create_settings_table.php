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


Schema::create('settings', function (Blueprint $table) {
$table->id();

$table->string('hospital_name')->nullable();
$table->string('hospital_code')->nullable();

$table->string('mobile')->nullable();
$table->string('email')->nullable();

$table->text('address')->nullable();

$table->string('logo')->nullable();

$table->string('gst_no')->nullable();

// Number Series
$table->string('uhid_prefix')->default('UHID');
$table->string('opd_prefix')->default('OPD');
$table->string('ipd_prefix')->default('IPD');
$table->string('bill_prefix')->default('BILL');

// Print
$table->text('bill_footer')->nullable();
$table->text('prescription_footer')->nullable();

// Notifications
$table->boolean('sms_enabled')->default(false);
$table->boolean('whatsapp_enabled')->default(false);

// Rules
$table->boolean('token_auto_generate')->default(true);
$table->integer('followup_days')->default(7);
$table->boolean('deposit_mandatory')->default(false);

$table->timestamps();
});    




}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('settings');
}
};
