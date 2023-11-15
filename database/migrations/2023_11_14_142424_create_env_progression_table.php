<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEnvProgressionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('env_progression', function (Blueprint $table) {
            $table->id();
            $table->string('reitor_name');
            $table->string('cppd_president');
            $table->string('cppd_secretary');
            $table->timestamps();
        });

        // Insert a record into the table
        DB::table('env_progression')->insert([
            'reitor_name' => 'Reitor Name',
            'cppd_president' => 'CPPD President',
            'cppd_secretary' => 'CPPD Secretary',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('env_progression');
    }
}
