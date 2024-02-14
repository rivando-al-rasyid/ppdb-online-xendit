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
        Schema::create('tbl_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->unique();
            $table->string('external_id')->unique();
            $table->text('description');
            $table->bigInteger('amount'); // Use 'bigInteger' for large integers
            $table->string('status');
            $table->string('checkout_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
