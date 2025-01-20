<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('care_center_department', function (Blueprint $table) {
            $table->char('id', 36)->primary(); // إزالة default UUID()
            $table->char('department_id', 36)->notNullable();
            $table->char('care_center_id', 36)->notNullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->decimal('app_price', 10, 2)->default(0)->notNullable();
            $table->unique(['department_id', 'care_center_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('care_center_department');
    }
};
