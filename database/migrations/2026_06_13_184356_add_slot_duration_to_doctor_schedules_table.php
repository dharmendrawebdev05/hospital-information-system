<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
Schema::table('doctor_schedules', function (Blueprint $table) {

$table->integer('slot_duration')
->default(20)
->after('day_name');

});
}

public function down(): void
{
Schema::table('doctor_schedules', function (Blueprint $table) {

$table->dropColumn('slot_duration');

});
}
};