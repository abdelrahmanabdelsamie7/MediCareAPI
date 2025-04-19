<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('department_hospital', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('department_id')->constrained('departments')->unique()->cascadeOnDelete()->cascdeOnUpdate();
            $table->foreignUuid('hospital_id')->constrained('hospitals')->unique()->cascadeOnDelete()->cascdeOnUpdate();
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->decimal('app_price', 10, 2)->default(0)->notNullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('department_hospital');
    }
};
