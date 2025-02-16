<?php

use App\Http\Controllers\Master\CustomerController;
use App\Http\Controllers\Master\MekanikController;
use App\Http\Controllers\Master\ServiceController;
use App\Http\Controllers\Master\SparepartController;
use App\Http\Controllers\Master\SuplierController;
use App\Http\Controllers\Order\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/laporan', function () {
    return view('laporan', ['title' => 'Laporan']);
})->middleware(['auth', 'verified'])->name('laporan');

Route::controller(SparepartController::class)
    ->prefix('laporan/sparepart')
    ->name('sparepart.')
    ->group(function () {
        Route::get('/', 'laporan')->name('laporan');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(SparepartController::class)
    ->prefix('laporan/penjualan-sparepart')
    ->name('penjualan-sparepart.')
    ->group(function () {
        Route::get('/', 'laporanPenjualan')->name('laporan');
        Route::get('/print', 'printPenjualan')->name('print');
    });

Route::controller(SparepartController::class)
    ->prefix('laporan/kategori-sparepart')
    ->name('kategori-sparepart.')
    ->group(function () {
        Route::get('/', 'laporan')->name('laporan');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(ServiceController::class)
    ->prefix('laporan/service')
    ->name('service.')
    ->group(function () {
        Route::get('/', 'laporan')->name('laporan');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(ServiceController::class)
    ->prefix('laporan/penjualan-service')
    ->name('penjualan-service.')
    ->group(function () {
        Route::get('/', 'laporanPenjualan')->name('laporan');
        Route::get('/print', 'printPenjualan')->name('print');
    });

Route::controller(TransaksiController::class)
    ->prefix('laporan/transaksi')
    ->name('transaksi.')
    ->group(function () {
        Route::get('/', 'laporan')->name('laporan');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(TransaksiController::class)
    ->prefix('laporan/stok-keluar')
    ->name('transaksi.')
    ->group(function () {
        Route::get('/', 'laporanStokKeluar')->name('laporanStokKeluar');
        Route::get('/print', 'printStokKeluar')->name('printStokKeluar');
    });

Route::controller(TransaksiController::class)
    ->prefix('laporan/stok-masuk')
    ->name('transaksi.')
    ->group(function () {
        Route::get('/', 'laporanStokMasuk')->name('laporanStokMasuk');
        Route::get('/print', 'printStokMasuk')->name('printStokMasuk');
    });

Route::controller(CustomerController::class)
    ->prefix('laporan/penjualan-customer')
    ->name('penjualan-customer.')
    ->group(function () {
        Route::get('/', 'laporanPenjualan')->name('laporan');
        Route::get('/print', 'printPenjualan')->name('print');
    });

Route::controller(CustomerController::class)
    ->prefix('laporan/customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/', 'laporan')->name('laporan');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(MekanikController::class)
    ->prefix('laporan/mekanik')
    ->name('mekanik.')
    ->group(function () {
        Route::get('/', 'laporan')->name('laporan');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(SuplierController::class)
    ->prefix('laporan/suplier')
    ->name('suplier.')
    ->group(function () {
        Route::get('/', 'laporan')->name('laporan');
        Route::get('/print', 'print')->name('print');
    });
