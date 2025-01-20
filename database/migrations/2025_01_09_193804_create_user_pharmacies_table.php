<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_pharmacies', function (Blueprint $table) {
            $table->id();
            $table->text('review');
            $table->unsignedTinyInteger('rating_value');
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('pharmacy_id')->constrained('pharmacies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['user_id', 'pharmacy_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('user_pharmacies');
    }
};
