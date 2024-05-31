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
        Schema::create('informasi_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->integer("tahun_ajar")->index();
            $table->date("tanggal_laporan");
            $table->string("nama_kepsek");
            $table->bigInteger("nip")->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_sekolahs');
    }
};
