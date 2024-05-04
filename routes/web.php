<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
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
        Route::get('history', [MahasiswaController::class, 'history'])->name('history');
        Route::get('jadwalBimbingan', [MahasiswaController::class, 'jadwalBimbingan'])->name('jadwalBimbingan');
    });

Route::prefix('dosen')
    ->name('dosen.')
    ->group(function () {
        Route::get('beranda', [DosenController::class, 'beranda'])->name('beranda');
        Route::get('daftarBimbingan', [DosenController::class, 'daftarBimbingan'])->name('daftarBimbingan');
        Route::get('pengajuanLomba', [DosenController::class, 'pengajuanLomba'])->name('pengajuanLomba');
        Route::get('jadwalBimbingan', [DosenController::class, 'jadwalBimbingan'])->name('jadwalBimbingan');
    });
    
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('beranda', [AdminController::class, 'beranda'])->name('beranda');
    });
