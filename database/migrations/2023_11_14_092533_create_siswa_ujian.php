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
        Schema::create('siswa_ujian', function (Blueprint $table) {
            $table->increments('id_siswa_ujian');
            $table->integer('id_ujian');
            $table->integer('id_siswa');
            $table->integer('id_soal');
            $table->string('jawaban')->nullable();
            $table->integer('point')->default(0);
            $table->boolean('ragu')->default(false);
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
        Schema::dropIfExists('siswa_ujian');
    }
};
