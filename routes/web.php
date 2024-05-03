<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;

Route::get('/login', function () {
    return view('auth.login');
});

Route::prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {
        Route::get('beranda', [MahasiswaController::class, 'beranda'])->name('beranda');
        Route::get('daftarDosenPembimbing', [MahasiswaController::class, 'daftarDosenPembimbing'])->name('daftarDosenPembimbing');
        Route::get('daftarPerlombaan', [MahasiswaController::class, 'daftarPerlombaan'])->name('daftarPerlombaan');
    });
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('beranda', [AdminController::class, 'beranda'])->name('beranda');
    });