<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('care_center_department', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->foreignUuid('department_id')->constrained('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('care_center_id')->constrained('care_centers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->decimal('app_price', 10, 2)->default(0);
            $table->unique(['department_id', 'care_center_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('care_center_department');
    }
};
