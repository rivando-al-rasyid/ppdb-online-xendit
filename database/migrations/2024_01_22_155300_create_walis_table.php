<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wali', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ayah');
            $table->unsignedBigInteger('id_pekerjaan_wali');
            $table->foreign('id_pekerjaan_wali')
                ->references('id')
                ->on('tbl_pekerjaan_ortu')
                ->onDelete('cascade');
            $table->BigInteger('no_tlp_wali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali');
    }
};
