<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id' )->primary();
            $table->string('google_id')->nullable()->unique(); // Store Google id
            $table->string('avatar')->nullable(); // Store Google profile picture url
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('verification_token')->nullable()->unique(); //  Email verification token
            $table->dateTime('verification_token_expires_at')->nullable(); //  Email verification token expiration
            $table->string('reset_token')->nullable();
            $table->timestamp('reset_token_expires_at')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('password')->nullable();
            $table->string('role')->default('user');
            $table->integer('points')->default(0);
            $table->timestamp('last_visit')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
