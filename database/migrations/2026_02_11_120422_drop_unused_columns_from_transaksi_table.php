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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn(['nohp', 'nama', 'meja_id', 'metodepambayaran', 'statusbeli', 'statusbayar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('nohp')->nullable();
            $table->string('nama')->nullable();
            $table->integer('meja_id')->nullable();
            $table->string('metodepambayaran')->nullable();
            $table->string('statusbeli')->nullable();
            $table->string('statusbayar')->nullable();
        });
    }
};
