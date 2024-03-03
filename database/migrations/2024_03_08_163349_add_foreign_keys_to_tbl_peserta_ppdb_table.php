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
        Schema::table('tbl_peserta_ppdb', function (Blueprint $table) {
            $table->foreign('id_biodata_ortu')->references('id')->on('tbl_biodata_ortu')->onDelete('cascade');
            $table->foreign('id_biodata_wali')->references('id')->on('tbl_biodata_wali')->onDelete('cascade');
            $table->foreign('id_file_rapor')->references('id')->on('tbl_file_rapor')->onDelete('cascade');
            $table->foreign('id_kartu')->references('id')->on('tbl_kartu')->onDelete('cascade');
            $table->foreign('id_invoice')->references('id')->on('tbl_pembayaran')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_peserta_ppdb', function (Blueprint $table) {
            $table->dropForeign(['id_biodata_ortu']);
            $table->dropForeign(['id_biodata_wali']);
            $table->dropForeign(['id_kartu']);
            $table->dropForeign(['id_file_rapor']);
            $table->dropForeign(['id_invoice']);
            $table->dropForeign(['id_user']);

        });
    }
};
