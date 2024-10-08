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
        Schema::create('driver_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->unsignedInteger('type_document_driver_id');
            $table->foreign('type_document_driver_id')->references('id')->on('type_document_drivers');
            $table->string('image');
            $table->string('identify_number')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->enum('status', ['WAITING_FOR_APPROVAL', 'EXPIRED_AND_DECLINED', 'NOT_UPLOADED','APPROVED', 'REJECTED'])->default('WAITING_FOR_APPROVAL');
//            $table->enum('approve', ['1', '0'])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_documents');
    }
};
