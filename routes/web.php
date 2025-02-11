<?php

use App\Http\Controllers\Master\MekanikController;
use App\Http\Controllers\Master\SuplierController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\TransaksiController;
use App\Http\Controllers\Master\CustomerController;
use App\Http\Controllers\Master\KategoriSparepartController;
use App\Http\Controllers\Master\ServiceController;
use App\Http\Controllers\Master\SparepartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(OrderController::class)
    ->prefix('cashier')
    ->name('order.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print/{nota}', 'print')->name('print');
    });

Route::controller(TransaksiController::class)
    ->prefix('cashier/transaksi')
    ->name('transaksi.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/void/{no_nota}', 'void')->name('void');
    });

Route::controller(TransaksiController::class)
    ->prefix('cashier/stok_masuk')
    ->name('stok_masuk.')
    ->group(function () {
        Route::get('/', 'stokMasuk')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/add', 'store')->name('store');
        Route::get('/void_masuk/{id}', 'void_masuk')->name('void_masuk');
    });
Route::controller(TransaksiController::class)
    ->prefix('cashier/stok_keluar')
    ->name('stok_keluar.')
    ->group(function () {
        Route::get('/', 'stokKeluar')->name('index');
        Route::get('/void/{no_nota}', 'void')->name('void');
    });

Route::controller(SparepartController::class)
    ->prefix('master/sparepart')
    ->name('sparepart.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });


Route::controller(KategoriSparepartController::class)
    ->prefix('master/sparepart/kategori')
    ->name('kategori.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(ServiceController::class)
    ->prefix('master/service')
    ->name('service.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(MekanikController::class)
    ->prefix('master/mekanik')
    ->name('mekanik.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(CustomerController::class)
    ->prefix('master/customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(SuplierController::class)
    ->prefix('master/suplier')
    ->name('suplier.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

require __DIR__ . '/auth.php';
require __DIR__ . '/laporan.php';
