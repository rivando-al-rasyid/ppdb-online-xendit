<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaPpdbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_peserta_ppdb', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('nisn');
            $table->bigInteger('nik');
            $table->bigInteger('no_kk');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->string('agama');
            $table->string('nilai_rata_rata');
            $table->string('agama');
            $table->string('asal_sekolah');
            $table->longText('alamat');
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
        Schema::dropIfExists('tbl_peserta_ppdb');
    }
}
