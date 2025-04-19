<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('care_center_department', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('department_id')->constrained('departments')->unique()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('care_center_id')->constrained('care_centers')->unique()->cascadeOnDelete()->cascadeOnUpdate();;
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->decimal('app_price', 10, 2)->default(0)->notNullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('care_center_department');
    }
};
