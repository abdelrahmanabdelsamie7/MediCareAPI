<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('doctor_offer_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('image');
            $table->foreignUuid('doctor_offer_id')->constrained('doctor_offers')->cascadeOnDelete()->cascadeOnUpdate(); // الربط بالعرض
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('doctor_offer_images');
    }
};
