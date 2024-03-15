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
        Schema::create('tbl_file', function (Blueprint $table) {
            $table->id();
            $table->string('rapor_semester_9')->nullable();
            $table->string('rapor_semester_10')->nullable();
            $table->string('rapor_semester_11')->nullable();
            $table->string('sertifikat_tpq')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_file');
    }
};
