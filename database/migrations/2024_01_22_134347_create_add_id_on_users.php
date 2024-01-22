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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_peserta_ppdb')->nullable();
            $table->foreign('id_peserta_ppdb')
                ->references('id')->on('tbl_peserta_ppdb')
                ->onDelete('set null');
            $table->string('status', 100)->nullable()->default('MENUNGGU');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_biodata_ortu', function (Blueprint $table) {
            //
        });

    }
};
