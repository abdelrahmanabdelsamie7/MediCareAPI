<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('service');
            $table->string('image')->nullable();
            $table->string('phone', 15);
            $table->text('address');
            $table->string('locationUrl');
            $table->string('whatsappLink');
            $table->boolean('deliveryOption')->default(1);
            $table->boolean('insurence')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->decimal('avg_rate', 4, 2)->default(0.00);
            $table->foreignUuid('chain_pharmacy_id')->nullable()->constrained('chain_pharmacies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
