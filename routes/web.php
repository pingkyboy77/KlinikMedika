<?php

use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\AdminAuthController;

Route::get('/', [AdminAuthController::class, 'index'])->name('login');
Route::post('/proses', [AdminAuthController::class, 'doLogin'])->name('proses.login');
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
// Route::get('/beranda', [AdminController::class, 'beranda'])->name('beranda');
Route::get('/beranda', [AdminController::class, 'index'])->name('beranda');
Route::get('/beranda/data', [AdminController::class, 'data'])->name('beranda.data');
Route::get('/beranda/export-pdf', [AdminController::class, 'exportPdf'])->name('beranda.export.pdf');

Route::resource('/user', AdminAuthController::class);
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/cek-email', function (Request $request) {
            $exists = \App\Models\User::where('email', $request->email)->exists();
            return response()->json(['exists' => $exists]);
        });
        // ---------------------------------------------------------------------------------------------------------

        // Route User
        Route::get('user-Management', [AdminController::class, 'userManagement'])->name('user-Management');
        Route::get('create-User', [AdminController::class, 'ShowStoreUser'])->name('create-User.show');
        Route::post('user-Management', [AdminController::class, 'storeUser'])->name('user-Management.store');
        Route::delete('user-Management/{id}', [AdminController::class, 'destroyuser'])->name('user.delete');
        Route::get('update-User/{id}/edit', [AdminController::class, 'updateUser'])->name('update-User');
        Route::post('update-User/{id}/edit', [AdminController::class, 'updatedUser'])->name('updated-User');

        // ---------------------------------------------------------------------------------------------------------

        // Route Region
        Route::get('/region', [RegionController::class, 'index'])->name('region.index');
        Route::get('/region/data-provinsi', [RegionController::class, 'dataProvinsi'])->name('region.data.provinsi');
        Route::get('/region/data-kabupaten', [RegionController::class, 'dataKabupaten'])->name('region.data.kabupaten');
        Route::get('/region/data-kecamatan', [RegionController::class, 'dataKecamatan'])->name('region.data.kecamatan');
        Route::get('/region/data-desa', [RegionController::class, 'dataDesa'])->name('region.data.desa');
        Route::get('/get-kabupaten/{id_prov}', [RegionController::class, 'getKabupatenByProv'])->name('admin.get.kabupaten');
        Route::get('/region/get-kabupaten/{id_prov}', [RegionController::class, 'getKabupaten']);
        Route::get('/region/get-kecamatan/{id_kab}', [RegionController::class, 'getKecamatan']);

        // Provinsi
        Route::post('/region/provinsi/store', [RegionController::class, 'storeProv'])->name('region.provinsi.store');
        Route::post('/region/provinsi/update/{id}', [RegionController::class, 'updateProvinsi'])->name('region.provinsi.update');
        Route::delete('/region/provinsi/destroy/{id}', [RegionController::class, 'destroyProv'])->name('region.provinsi.destroy');

        // Kabupaten
        Route::post('/region/kabupaten/store', [RegionController::class, 'storeKab'])->name('region.kabupaten.store');
        Route::post('/region/kabupaten/update/{id}', [RegionController::class, 'updateKabupaten'])->name('region.kabupaten.update');
        Route::delete('/region/kabupaten/destroy/{id}', [RegionController::class, 'destroyKab'])->name('region.kabupaten.destroy');

        // Kecamatan
        Route::post('/region/kecamatan/store', [RegionController::class, 'storeKec'])->name('region.kecamatan.store');
        Route::post('/region/kecamatan/update/{id}', [RegionController::class, 'updateKecamatan'])->name('region.kecamatan.update');
        Route::delete('/region/kecamatan/destroy/{id}', [RegionController::class, 'destroyKec'])->name('region.kecamatan.destroy');

        // Desa
        Route::post('/region/desa/store', [RegionController::class, 'storeDes'])->name('region.desa.store');
        Route::post('/region/desa/update/{id}', [RegionController::class, 'updateDesa'])->name('region.desa.update');
        Route::delete('/region/desa/destroy/{id}', [RegionController::class, 'destroyDes'])->name('region.desa.destroy');

        // ---------------------------------------------------------------------------------------------------------
        // Route Staff
        Route::resource('staff', StaffController::class)->except(['create', 'edit', 'show']);
        Route::get('/staff/data', [StaffController::class, 'getData'])->name('staff.getData');
        Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');

        Route::get('/staff/{id}', [StaffController::class, 'show'])->name('staff.show');

        Route::get('staff/{staff}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::get('staff/{staff}', [StaffController::class, 'show'])->name('staff.show');

        // DataTables JSON endpoint

        // Dynamic region fetching for dependent dropdowns
        Route::get('staff/get-kabupaten/{id_prov}', [StaffController::class, 'getKabupatens'])->name('staff.getKabupaten');
        Route::get('staff/get-kecamatan/{id_kab}', [StaffController::class, 'getKecamatans'])->name('staff.getKecamatan');
        Route::get('staff/get-desa/{id_kec}', [StaffController::class, 'getDesas'])->name('staff.getDesa');

        // SERVICE
        Route::resource('services', ServiceController::class)->except(['show']);

        // DRUG
        Route::resource('drugs', DrugController::class);

        // PASIEN
    });

Route::prefix('staff')
    ->name('staff.')
    ->middleware(['auth', 'role:admin,staff'])
    ->group(function () {
        // passien
        Route::resource('pasiens', PasienController::class)->except(['show']);
        Route::get('/pasiens/get-kabupaten/{id_prov}', [StaffController::class, 'getKabupatens'])->name('pasiens.getKabupaten');
        Route::get('/pasiens/get-kecamatan/{id_kab}', [StaffController::class, 'getKecamatans'])->name('pasiens.getKecamatan');
        Route::get('/pasiens/get-desa/{id_kec}', [StaffController::class, 'getDesas'])->name('pasiens.getDesa');

        // Visit
        Route::get('generate-visit', [TindakanController::class, 'create'])->name('pasiens.generate-visit');
        Route::post('generate-visit/store', [TindakanController::class, 'store'])->name('pasiens.generate-visit.store');
        Route::get('visit', [VisitController::class, 'index'])->name('visit.index');
        Route::get('visit/data', [VisitController::class, 'data'])->name('visit.data');
        Route::post('visit/{id}/cancel', [VisitController::class, 'cancel'])->name('visit.cancel');
    });

// Untuk dokter lihat dan eksekusi treatment
Route::middleware(['auth', 'role:dokter, admin'])
    ->prefix('dokter')
    ->name('dokter.')
    ->group(function () {
        Route::get('tindakan', [TindakanController::class, 'listForDoctor'])->name('tindakan.index');
        Route::get('tindakan/data', [TindakanController::class, 'data'])->name('tindakan.data');
        Route::get('tindakan/{transaction}/execute', [TindakanController::class, 'edit'])->name('tindakan.edit');
        Route::post('tindakan/{transaction}/execute', [TindakanController::class, 'update'])->name('tindakan.update');
    });

// kasir
Route::middleware(['auth', 'role:kasir, admin'])
    ->prefix('kasir')
    ->name('kasir.')
    ->group(function () {
        Route::get('billing', [BillingController::class, 'index'])->name('billing.index');
        Route::get('billing/data', [BillingController::class, 'data'])->name('billing.data');
        Route::get('/billing/{id}/print-bill', [BillingController::class, 'printBill'])->name('billing.print');
    Route::post('/billing/{id}/confirm-payment', [BillingController::class, 'confirmPayment'])->name('billing.confirm');
    });
