<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('initial_time_id')->nullable();
            $table->unsignedBigInteger('end_time_id')->nullable();

            $table->foreign('initial_time_id')->references('id')->on('schedules');
            $table->foreign('end_time_id')->references('id')->on('schedules');
            $table->dropColumn(['end_time', 'initial_time']);
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['initial_time_id']);
            $table->dropForeign(['end_time_id']);
            $table->dropColumn(['initial_time_id', 'end_time_id']);
            $table->string('initial_time',10);
            $table->string('end_time',10);
        });
    }
};
