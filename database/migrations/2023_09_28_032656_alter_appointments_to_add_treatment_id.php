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
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId("treatment_id")->nullable()->after('deleted')->references("id")->on('treatments');
        });
        Schema::table('treatments', function (Blueprint $table) {
            $table->dropForeign('treatments_appointment_id_foreign');
            $table->dropColumn('appointment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            //
            $table->dropForeign('treatment_id');
            $table->dropColumn('treatment_id');

        });
        Schema::table('treatments', function (Blueprint $table) {
            //
            $table->foreignId("appointment_id")->references("id")->on('appointments');
        });
    }
};
