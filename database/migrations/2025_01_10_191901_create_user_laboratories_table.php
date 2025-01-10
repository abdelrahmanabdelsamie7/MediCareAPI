<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_laboratories', function (Blueprint $table) {
            $table->id();
            $table->text('review');
            $table->unsignedTinyInteger('rating_value');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('laboratory_id')->constrained('laboratories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['user_id', 'laboratory_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('user_laboratories');
    }
};
