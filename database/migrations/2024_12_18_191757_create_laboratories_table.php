<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('service');
            $table->string('image')->nullable();
            $table->string('phone', 15);
            $table->text('address');
            $table->string('locationUrl');
            $table->string('whatsappLink');
            $table->boolean('insurence')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->decimal('avg_rate', 4, 2)->default(0.00);
            $table->foreignId('chain_laboratory_id')->constrained('chain_laboratories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};
