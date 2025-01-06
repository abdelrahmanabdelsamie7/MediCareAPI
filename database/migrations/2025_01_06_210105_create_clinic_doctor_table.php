<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clinic_doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('clinic_id')->constrained('clinics')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['doctor_id', 'clinic_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_doctor');
    }
};
