<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('care_centers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('service');
            $table->string('image')->nullable();
            $table->string('phone', 15);
            $table->text('address');
            $table->string('locationUrl');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('care_centers');
    }
};
