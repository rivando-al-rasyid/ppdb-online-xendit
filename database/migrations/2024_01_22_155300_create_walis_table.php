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
        Schema::create('tbl_wali', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pekerjaan_wali')->nullable();
            $table->foreign('id_pekerjaan_wali')
                ->references('id')
                ->on('tbl_pekerjaan_ortu')
                ->onDelete('cascade');
            $table->string('nama_wali')->nullable();
            $table->BigInteger('no_tlp_wali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_wali');
    }
};
