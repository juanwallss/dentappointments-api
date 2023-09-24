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
        Schema::create('treatmentdrugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->references('id')->on('treatments');
            $table->foreignId('drug_id')->references('id')->on('drugs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatmentdrugs');
    }
};
