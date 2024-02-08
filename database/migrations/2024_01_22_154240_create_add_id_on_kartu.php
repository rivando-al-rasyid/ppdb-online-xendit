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
        Schema::table('tbl_kartu', function (Blueprint $table) {
            $table->unsignedBigInteger('id_peserta_ppdb');
            $table->foreign('id_peserta_ppdb')
                ->references('id')
                ->on('tbl_peserta_ppdb')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_kartu', function (Blueprint $table) {
            // Drop the foreign key constraint
        });
    }
};
