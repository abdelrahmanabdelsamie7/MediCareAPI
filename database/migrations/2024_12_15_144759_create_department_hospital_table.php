<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('department_hospital', function (Blueprint $table) {
            $table->char('id', 36)->primary(); // بدون default UUID()
            $table->char('department_id', 36)->notNullable();
            $table->char('hospital_id', 36)->notNullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->decimal('app_price', 10, 2)->default(0)->notNullable();
            $table->unique(['department_id', 'hospital_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('department_hospital');
    }
};
