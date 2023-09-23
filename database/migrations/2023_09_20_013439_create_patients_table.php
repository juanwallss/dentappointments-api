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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('father_lastname',20);
            $table->string('mother_lastname', 20)->nullable();
            $table->string('phone', 20);
            $table->string('email', 40);
            $table->string('street', 50);
            $table->string('state', 25);
            $table->string('city', 45);
            $table->string('country', 80);
            $table->integer('postal_code');
            $table->date('date_of_birth');
            $table->enum('gender',['M', 'H']);
            $table->tinyInteger('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
