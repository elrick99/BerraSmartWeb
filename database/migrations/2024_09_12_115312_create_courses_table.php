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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('Description');
            $table->string('lieu_depart')->nullable();
            $table->string('lieu_arrivee')->nullable();
            $table->unsignedInteger('user_id')->comment('client');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('driver_id')->comment('driver')->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->enum('etat',['en attente','en cours de livraison','livree','annulee'])->default('en attente');
            $table->float('price')->default(0);
            $table->string('duration')->default('00:00:00');
            $table->dateTime('heure_depart')->nullable();
            $table->dateTime('heure_arrivee')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
