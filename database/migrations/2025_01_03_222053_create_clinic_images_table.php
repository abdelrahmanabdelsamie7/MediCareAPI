<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('clinic_images', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->foreignId('clinic_id')->constrained('clinics')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('clinic_images');
    }
};
