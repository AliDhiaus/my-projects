<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_users', function (Blueprint $table) {
            $table->string('nik')->primary();
            $table->string('name');
            $table->date('date');
            $table->string('gender');
            $table->string('academy');
            $table->string('religion');
            $table->string('status');
            $table->string('job');
            $table->string('old');
            $table->string('ipwl')->nullable();
            $table->date('date_of_birth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_users');
    }
};
