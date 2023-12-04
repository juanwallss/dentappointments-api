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
        Schema::create('cita_tratamiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tratamiento_id')->references('id')->on('tratamientos');
            $table->foreignId('cita_id')->references('id')->on('citas');
            $table->timestamps();
        });
        Schema::table('citas', function (Blueprint $table) {
            //
            $table->dropForeign('citas_treatment_id_foreign');
            $table->dropColumn('treatment_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_tratamiento');
    }
};
