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
        Schema::create('soal', function (Blueprint $table) {
            $table->increments('id_soal');
            $table->integer('id_bank_soal');
            $table->text('soal')->nullable();
            $table->string('pil_a');
            $table->string('pil_b');
            $table->string('pil_c');
            $table->string('pil_d');
            $table->string('pil_e')->nullable();
            $table->string('jawaban');
            $table->string('file_1')->nullable();
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
        Schema::dropIfExists('soal');
    }
};
