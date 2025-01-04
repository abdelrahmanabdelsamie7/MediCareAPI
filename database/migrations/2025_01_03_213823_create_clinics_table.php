<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('address');
            $table->string('locationUrl');
            $table->string('phone', 15);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
