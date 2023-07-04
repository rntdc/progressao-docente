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
        Schema::create('professors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('level', 100)->nullable();
            $table->string('class', 100)->nullable();
            $table->string('form', 100)->nullable();
            $table->string('situation', 100)->nullable();
            $table->integer('siape')->nullable();
            $table->datetime('entry_date')->nullable();
            $table->datetime('last_progression_date')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professors');
    }
};
