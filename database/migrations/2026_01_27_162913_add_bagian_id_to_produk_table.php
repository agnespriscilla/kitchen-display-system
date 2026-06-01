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
        if (Schema::hasColumn('produk', 'bagian_id')) {
            try {
                Schema::table('produk', function (Blueprint $table) {
                    $table->dropForeign(['bagian_id']);
                });
            } catch (\Exception $e) {
            }

            try {
                Schema::table('produk', function (Blueprint $table) {
                    $table->dropColumn('bagian_id');
                });
            } catch (\Exception $e) {
            }
        }

        Schema::table('produk', function (Blueprint $table) {
            $table->integer('bagian_id')->nullable()->after('kategori');
            $table->foreign('bagian_id')->references('id')->on('bagian')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropForeign(['bagian_id']);
            $table->dropColumn('bagian_id');
        });
    }
};
