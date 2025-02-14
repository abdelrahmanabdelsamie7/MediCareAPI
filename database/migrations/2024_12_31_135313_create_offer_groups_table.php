<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
   public function up(): void
    {
        Schema::create('offer_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('image') ;
            $table->string('title');
            $table->timestamps();
        });
    }
     public function down(): void
    {
        Schema::dropIfExists('offer_groups');
    }
};
