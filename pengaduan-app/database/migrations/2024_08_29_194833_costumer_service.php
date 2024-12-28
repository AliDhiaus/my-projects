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
        Schema::create('costumer_service', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('no_kontrak');
            $table->string('keluhan');
            $table->unsignedBigInteger('user_id');
            $table->string('status')->nullable();
            $table->string('tanggapan')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->rememberToken();
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
        //
    }
};
