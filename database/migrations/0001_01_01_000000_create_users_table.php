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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 25)->unique()->nullable();
            $table->string('email')->unique();
            $table->string('mobile', 14);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('email_confirmed')->default(false);
            $table->boolean('mobile_confirmed')->default(false);
            $table->enum('gender', ['Homme', 'Femme'])->default('Homme');
            $table->string('fcm_token')->nullable();
            $table->string('indicator_tel')->nullable();
            $table->float('rating')->default(0);
            $table->unsignedInteger('country')->nullable();
            $table->float('rating_total')->default(0);
            $table->enum('role', ['admin', 'user', 'driver'])->default('user');
            $table->enum('login_by', ['android','ios'])->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
