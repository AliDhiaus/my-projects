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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->int('user_id');
            $table->string('tanggal');
            $table->string('kejuruan');
            $table->string('kelas');
            $table->string('jam_masuk')->nullable();
            $table->string('jam_keluar')->nullable();
            $table->string('keterangan');
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
