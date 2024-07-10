<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peserta_ppdb');
            $table->foreign('id_peserta_ppdb')->references('id')->on('tbl_peserta_ppdb'); // Assuming you have a students table
            $table->decimal('nilai_mtk_5_1', 5, 2)->nullable();
            $table->decimal('nilai_ipa_5_1', 5, 2)->nullable();
            $table->decimal('nilai_bi_5_1', 5, 2)->nullable();
            $table->decimal('nilai_mtk_5_2', 5, 2)->nullable();
            $table->decimal('nilai_ipa_5_2', 5, 2)->nullable();
            $table->decimal('nilai_bi_5_2', 5, 2)->nullable();
            $table->decimal('nilai_mtk_6_1', 5, 2)->nullable();
            $table->decimal('nilai_ipa_6_1', 5, 2)->nullable();
            $table->decimal('nilai_bi_6_1', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_nilais');
    }
};
