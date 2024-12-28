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
        Schema::create('isi_das', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('das_id');
            $table->string('waktu');
            $table->string('program');
            $table->string('frame');
            $table->string('durasi');
            $table->string('keterangan');
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
        Schema::dropIfExists('isi_das');
    }
};
