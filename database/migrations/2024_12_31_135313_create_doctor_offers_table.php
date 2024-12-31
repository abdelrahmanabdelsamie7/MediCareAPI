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
        Schema::create('doctor_offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('info_about_offer')->nullable();
            $table->text('details');
            $table->decimal('price_before_discount', 10, 2);
            $table->decimal('discount', 5, 2);
            $table->date('from_day');
            $table->date('to_day');
            $table->boolean('is_active')->default(true);
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_offers');
    }
};
