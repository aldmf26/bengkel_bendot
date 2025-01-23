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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->constrained('transactions');
            $table->foreignId('id_spare_part')->nullable()->constrained('spareparts');
            $table->foreignId('id_layanan')->nullable()->constrained('services');
            $table->integer('jumlah');
            $table->decimal('harga', 15, 2);
            $table->string('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
