<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title'); // Title Of Department
            $table->text('description'); // This is Description To Department
            $table->string('icon');// This is The Icon that appear in Home Page
            $table->timestamps(); // Created at & Update at Time
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
