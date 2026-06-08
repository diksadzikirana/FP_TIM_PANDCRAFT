<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddStokConstraintToProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tambahkan CHECK constraint untuk memastikan stok tidak negatif
        // Ini dijalankan dengan raw SQL karena Laravel Blueprint belah fully support CHECK constraints
        DB::statement('ALTER TABLE tb_produk ADD CONSTRAINT chk_stok_non_negative CHECK (stok >= 0)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop constraint saat rollback
        DB::statement('ALTER TABLE tb_produk DROP CONSTRAINT chk_stok_non_negative');
    }
}
