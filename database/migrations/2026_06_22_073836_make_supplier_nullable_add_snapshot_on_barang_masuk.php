<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop old FK, make nullable, re-add with SET NULL
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->unsignedBigInteger('supplier_id')->nullable()->change();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
            $table->string('supplier_nama')->nullable()->after('supplier_id');
        });

        // Backfill supplier_nama from existing records
        DB::statement('
            UPDATE barang_masuk
            INNER JOIN suppliers ON barang_masuk.supplier_id = suppliers.id
            SET barang_masuk.supplier_nama = suppliers.nama
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropColumn('supplier_nama');
            $table->unsignedBigInteger('supplier_id')->nullable(false)->change();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }
};
