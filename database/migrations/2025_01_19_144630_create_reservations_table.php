<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('doctor_id')->constrained('doctors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('clinic_id')->constrained('clinics')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('appointment_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['pending', 'confirmed', 'canceled', 'visited'])->default('pending');
            $table->string('payment_intent_id')->nullable();
            $table->string('currency', 10)->default('EGP');
            $table->enum('payment_status', ['pending', 'succeeded', 'failed'])->default('pending');
              $table->decimal('final_price', 8, 2)->default(0);
            $table->string('payment_method')->nullable(); 
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};