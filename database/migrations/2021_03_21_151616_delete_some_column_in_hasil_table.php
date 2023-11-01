<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteSomeColumnInHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_hasil', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('asal_sekolah');
            $table->unsignedBigInteger('user_id')->nullable(); // Use unsignedBigInteger for the foreign key column
            $table->foreign('user_id')->references('id')->on('users'); // Establ
            $table->string('status', 100)->nullable()->default('MENUNGGU');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_hasil', function (Blueprint $table) {
            //
        });
    }
}
