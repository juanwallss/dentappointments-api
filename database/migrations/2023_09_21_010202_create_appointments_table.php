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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('initial_time',10);
            $table->string('end_time',10);
            $table->enum('status', ['AGENDADA', 'CANCELADA', 'REALIZADA'])->default('AGENDADA');
            $table->foreignId('paciente_id')->references('id')->on('pacientes');
            $table->foreignId('doctor_id')->references('id')->on('doctores');
            $table->tinyInteger('eliminado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
