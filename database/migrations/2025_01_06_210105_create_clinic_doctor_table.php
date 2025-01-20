<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('clinic_doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('doctor_id')->constrained('doctors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('clinic_id')->constrained('clinics')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['doctor_id', 'clinic_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('clinic_doctor');
    }
};
