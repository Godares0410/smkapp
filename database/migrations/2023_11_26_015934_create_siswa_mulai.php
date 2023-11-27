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
        Schema::create('siswa_mulai', function (Blueprint $table) {
            $table->increments('id_siswa_mulai');
            $table->integer('id_jadwal_ujian');
            $table->integer('id_siswa');
            $table->timestamp('mulai');
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
        Schema::dropIfExists('siswa_mulai');
    }
};
