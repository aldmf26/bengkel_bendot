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
        Schema::create('log_transaksi_stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_spare_part')->constrained('spareparts');
            $table->dateTime('tanggal');
            $table->enum('jenis_transaksi', ['penjualan', 'stock_in', 'opname']);
            $table->integer('jumlah');
            $table->integer('stok_sebelum');
            $table->integer('stok_sesudah');
            $table->string('keterangan')->nullable();
            $table->string('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_transaksi_stoks');
    }
};
