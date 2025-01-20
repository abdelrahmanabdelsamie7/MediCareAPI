<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('day');
            $table->time('start_at');
            $table->time('end_at');
            $table->integer('duration')->default(20);
            $table->boolean('is_booked')->default(false);
            $table->foreignUuid('doctor_id')->constrained('doctors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('clinic_id')->constrained('clinics')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
