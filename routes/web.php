<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\MahasiswaController;

// Route::get('/login', [AdminAuthController::class, 'index'])
//     ->name('login')
//     ->middleware('guest');
Route::get('/', [AdminAuthController::class, 'index']);
Route::post('/dashboard', [AdminAuthController::class, 'doLogin'])->name('proses.login');

Route::prefix('/')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/logout', [AdminAuthController::class, 'logout']);
        Route::resource('/user', AdminAuthController::class);
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
                Route::get('user-Management', [AdminController::class, 'userManagement'])->name('user-Management');
                Route::post('user-Management', [AdminController::class, 'store'])->name('user-Management.store');
            });
    });
