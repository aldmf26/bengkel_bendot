<?php

use App\Http\Controllers\Master\SparepartController;
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


