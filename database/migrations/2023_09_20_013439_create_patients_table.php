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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('apellido_paterno',20);
            $table->string('apellido_materno', 20)->nullable();
            $table->string('telefono', 20);
            $table->string('email', 40);
            $table->string('calle', 50);
            $table->string('estado', 25);
            $table->string('ciudad', 45);
            $table->string('pais', 80);
            $table->integer('postal_code');
            $table->date('fecha_nac');
            $table->enum('genero',['M', 'H']);
            $table->tinyInteger('eliminado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
