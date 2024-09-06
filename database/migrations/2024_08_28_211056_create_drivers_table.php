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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('vehicule_marque_id');
            $table->unsignedInteger('vehicule_type_id');
            $table->string('car_color')->nullable();
            $table->string('car_number')->nullable();
            $table->integer('today_trip_count')->default(0);
            $table->integer('total_accept')->default(0);
            $table->integer('total_reject')->default(0);
            $table->enum('status',['1','0'])->default(0);
            $table->enum('approve',['1','0'])->default(0);
            $table->enum('available',['1','0'])->default(0);
            $table->foreign('vehicule_marque_id')->references('id')->on('vehicule_marques');
            $table->foreign('vehicule_type_id')->references('id')->on('vehicule_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('gender', ['Homme','Femme'])->default('Homme');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
