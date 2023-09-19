<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type', 100)->default('null');
            $table->string('level', 100)->nullable();
            $table->string('class', 100)->nullable();
            $table->string('form', 100)->nullable();
            $table->string('situation', 100)->nullable();
            $table->integer('siape')->nullable();
            $table->datetime('entry_date')->nullable();
            $table->datetime('last_progression_date')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->date('date_of_birth'); // Add the date_of_birth column
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
