<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_subitem')->nullable(); // Make the foreign key nullable
            $table->foreign('id_subitem')->references('id')->on('subitems');
            $table->unsignedBigInteger('id_item');
            $table->foreign('id_item')->references('id')->on('items');
            $table->string('name');
            $table->string('index')->nullable();
            $table->string('pontuation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
