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
        Schema::create('vehicule_types', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->text('description');
            $table->unsignedInteger('vehicule_marque_id');
            $table->foreign('vehicule_marque_id')->references('id')->on('vehicule_marques');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicule_types');
    }
};
