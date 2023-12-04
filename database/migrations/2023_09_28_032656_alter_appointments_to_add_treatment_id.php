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
        Schema::table('citas', function (Blueprint $table) {
            $table->foreignId("treatment_id")->nullable()->after('eliminado')->references("id")->on('tratamientos');
        });
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->dropForeign('tratamientos_cita_id_foreign');
            $table->dropColumn('cita_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            //
            $table->dropForeign('treatment_id');
            $table->dropColumn('treatment_id');

        });
        Schema::table('tratamientos', function (Blueprint $table) {
            //
            $table->foreignId("cita_id")->references("id")->on('citas');
        });
    }
};
