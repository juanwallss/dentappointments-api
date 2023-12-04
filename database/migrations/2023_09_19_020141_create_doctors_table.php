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
        Schema::create('doctores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('apellido_paterno', 20);
            $table->string('apellido_materno', 20)->nullable();
            $table->string('ced_prof', 15)->unique();
            $table->string('telefono', 20);
            $table->string('email', 40);
            $table->enum('genero', ['H', 'M'])->nullable()->default(null);
            $table->tinyInteger('contratado')->default(false);
            $table->tinyInteger('eliminado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
