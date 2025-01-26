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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelanggan')->constrained('customers');
            $table->string('no_nota');
            $table->dateTime('tanggal');
            $table->decimal('total_harga', 15, 2);
            $table->enum('metode_pembayaran', ['tunai', 'qris', 'transfer']);
            $table->decimal('jumlah_dibayar', 15, 2);
            $table->decimal('kembalian', 15, 2);
            $table->string('admin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
