<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('laboratories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('service');
            $table->string('image')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('city');
            $table->string('area');
            $table->string('locationUrl')->nullable();
            $table->string('whatsappLink')->nullable();
            $table->boolean('insurence')->default(0);
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->decimal('avg_rate', 4, 2)->default(0.00);
            $table->foreignUuid('chain_laboratory_id')->nullable()
                ->constrained('chain_laboratories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};