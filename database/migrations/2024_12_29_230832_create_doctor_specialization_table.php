<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('doctor_specialization', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->foreignUuid('doctor_id')->constrained('doctors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('specialization_id')->constrained('specializations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['doctor_id', 'specialization_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('doctor_specialization');
    }
};
