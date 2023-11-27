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
        Schema::create('siswa_nilai', function (Blueprint $table) {
            $table->increments('id_siswa_nilai');
            $table->integer('id_siswa');
            $table->integer('id_kelas');
            $table->integer('id_jurusan');
            $table->integer('id_jenis');
            $table->integer('id_mapel');
            $table->integer('nilai');
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
        Schema::dropIfExists('siswa_nilai');
    }
};
