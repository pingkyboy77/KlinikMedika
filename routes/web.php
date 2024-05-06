<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;

// Route::get('/login', [AdminAuthController::class, 'index'])
//     ->name('login')
//     ->middleware('guest');
// Route::get('/', [AdminAuthController::class, 'landing']);


// Route::prefix('/beranda')
//     ->middleware(['auth'])
//     ->group(function () {
//         Route::get('/logout', [AdminAuthController::class, 'logout']);
//         Route::resource('/user', AdminAuthController::class);

//     });
Route::get('/', [AdminAuthController::class, 'index'])->name('login');
Route::post('/proses', [AdminAuthController::class, 'doLogin'])->name('proses.login');
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
// Route::get('user-Management', [AdminController::class, 'userManagement'])->name('user-Management');
// Route::post('user-Management', [AdminController::class, 'storeUser'])->name('user-Management.store');
Route::resource('/user', AdminAuthController::class);
Route::prefix('mahasiswa')
    ->name('mahasiswa.')
    ->middleware(['auth', 'role:mahasiswa'])
    ->group(function () {
        
        Route::get('beranda', [MahasiswaController::class, 'beranda'])->name('beranda');
        Route::get('daftarDosenPembimbing', [MahasiswaController::class, 'daftarDosenPembimbing'])->name('daftarDosenPembimbing');
        Route::get('daftarPerlombaan', [MahasiswaController::class, 'daftarPerlombaan'])->name('daftarPerlombaan');
        // Route::post('daftarPerlombaan', [MahasiswaController::class, 'store'])->name('daftarPerlombaan.store');
        Route::get('history', [MahasiswaController::class, 'history'])->name('history');
        Route::get('jadwalBimbingan', [MahasiswaController::class, 'jadwalBimbingan'])->name('jadwalBimbingan');
        Route::get('pengajuan-lomba/{nama_lomba}/{nama_akun}/{id}', [MahasiswaController::class, 'pengajuanLomba'])->name('pengajuan-lomba');
        Route::post('daftarPerlombaan', [MahasiswaController::class, 'pengajuanLombaStore'])->name('store.pengajuan-lomba');
    });

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('beranda', [AdminController::class, 'beranda'])->name('beranda');
        Route::get('daftarPengajuanLomba', [AdminController::class, 'daftarPengajuanLomba'])->name('daftarPengajuanLomba');
        Route::get('update-daftarPengajuanLomba/{id}/edit', [AdminController::class, 'updatedaftarPengajuanLomba'])->name('update.daftarPengajuanLomba');
        Route::post('update-daftarPengajuanLomba/{id}/edit', [AdminController::class, 'updateddaftarPengajuanLomba'])->name('updated.daftarPengajuanLomba');
        Route::delete('daftarPengajuanLomba/{id}', [AdminController::class, 'destroyDaftarPengajuanLomba'])->name('DaftarPengajuan.delete');
        Route::get('user-Management', [AdminController::class, 'userManagement'])->name('user-Management');
        Route::post('user-Management', [AdminController::class, 'storeUser'])->name('user-Management.store');
        // Route::get('/user/{id}/edit', [AdminController::class, 'editUser'])->name('user-Management.edit');
        // Route::put('/user/{id}', [AdminController::class, 'updateUser'])->name('user.update');
        // Route::post('user-Management', [AdminController::class, 'store'])->name('user-Management.store');
        Route::delete('user-Management/{id}', [AdminController::class, 'destroyuser'])->name('user.delete');
        Route::get('update-User/{id}/edit', [AdminController::class, 'updateUser'])->name('update-User');
        Route::post('update-User/{id}/edit', [AdminController::class, 'updatedUser'])->name('updated-User');
        Route::get('lomba-Management', [AdminController::class, 'lombaManagement'])->name('lomba-Management');
        Route::post('lomba-Management', [AdminController::class, 'storelomba'])->name('lomba-Management.store');
        Route::delete('lomba-Management/{id}', [AdminController::class, 'destroylomba'])->name('lomba.delete');
        Route::get('update-Lomba/{id}/edit', [AdminController::class, 'updateLomba'])->name('update-Lomba');
        Route::post('update-Lomba/{id}/edit', [AdminController::class, 'updatedLomba'])->name('updated-Lomba');
        Route::get('lomba-Management', [AdminController::class, 'lombaManagement'])->name('lomba-Management');
        Route::get('kategori-Management', [AdminController::class, 'kategoriManagement'])->name('kategori-Management');
        Route::post('kategori-Management', [AdminController::class, 'storekategori'])->name('kategori-Management.store');
        Route::delete('kategori-Management/{id}', [AdminController::class, 'destroykategori'])->name('kategori.delete');
        Route::get('update-Kategori/{id}/edit', [AdminController::class, 'updateKategori'])->name('update-Kategori');
        Route::post('update-Kategori/{id}/edit', [AdminController::class, 'updatedKategori'])->name('updated-Kategori');
        // Route::put('update-Kategori/{id}', [AdminController::class, 'updatedKategori'])->name('Kategori.update');
        // Route::delete('kategori-Management/{id}', [AdminController::class, 'updatekategori'])->name('lomba.update');

    });

Route::prefix('dosen')
    ->name('dosen.')
    ->middleware(['auth', 'role:dosen'])
    ->group(function () {
        Route::get('beranda', [DosenController::class, 'beranda'])->name('beranda');
        Route::get('daftarBimbingan', [DosenController::class, 'daftarBimbingan'])->name('daftarBimbingan');
        Route::get('pengajuanLomba', [DosenController::class, 'pengajuanLomba'])->name('pengajuanLomba');
        Route::get('jadwalBimbingan', [DosenController::class, 'jadwalBimbingan'])->name('jadwalBimbingan');
    });
