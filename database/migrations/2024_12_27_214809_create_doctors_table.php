<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('fName');
            $table->string('lName');
            $table->enum('gender', ['male', 'female']);
            $table->date('birthDate');
            $table->string('phone', 15);
            $table->text('image');
            $table->string('whatsappLink');
            $table->string('facebookLink');
            $table->string('title');
            $table->text('infoAboutDoctor');
            $table->decimal('app_price', 10, 2)->default(0);
            $table->boolean('homeOption')->default(false);
            $table->decimal('avg_rate', 4, 2)->default(0.00);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('doctor');
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
