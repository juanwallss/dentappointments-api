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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('initial_time',10);
            $table->string('end_time',10);
            $table->enum('status', ['AGENDADA', 'CANCELADA', 'REALIZADA'])->default('AGENDADA');
            $table->foreignId('patient_id')->references('id')->on('patients');
            $table->foreignId('doctor_id')->references('id')->on('doctors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
