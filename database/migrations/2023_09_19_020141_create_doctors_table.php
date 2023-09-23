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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('father_lastname', 20);
            $table->string('mother_lastname', 20)->nullable();
            $table->string('professional_id', 15);
            $table->string('phone', 20);
            $table->string('email', 40);
            $table->tinyInteger('hired')->default(false);
            $table->tinyInteger('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
