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
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->bigInteger('nisn');
            $table->bigInteger('nik');
            $table->bigInteger('no_kk');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('agama');
            $table->decimal('nilai_rata_rata', 8, 2)->nullable();
            $table->string('asal_sekolah');
            $table->longText('alamat');

            // Foreign keys
            $table->unsignedBigInteger('id_biodata_ortu')->nullable();

            $table->unsignedBigInteger('id_biodata_wali')->nullable();

            $table->unsignedBigInteger('id_kartu')->nullable();

            $table->unsignedBigInteger('id_invoice')->nullable();

            $table->unsignedBigInteger('id_user')->nullable();

            // Timestamps
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
