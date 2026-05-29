<?php
use App\Http\Controllers\admin\BarangKeluarController;
use App\Http\Controllers\Admin\BarangMasukController;
use App\Http\Controllers\admin\kategoriController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\admin\suppliercontroller;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\BarangAdminController;
use App\Http\Controllers\manajer\DashboardManajerController;
use App\Http\Controllers\manajer\BarangManajerController;
use App\Http\Controllers\admin\PenggunaController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [loginController::class, 'index'])->name('login');
    Route::post('/', [loginController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [loginController::class, 'logout'])->name('logout');

    Route::prefix('admin')->middleware('role:admin_gudang')->group(function () {
        Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboardadmin');
        Route::get('/barang', [BarangAdminController::class, 'index'])->name('brgadmin');
        Route::get('/barang/export', [BarangAdminController::class, 'export'])->name('brgadmin.export');
        Route::put('/barang/{id}', [BarangAdminController::class, 'update'])->name('brgadmin.update');
        Route::resource('pengguna', PenggunaController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->names('admin.pengguna');
        Route::resource('kategori', kategoriController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->names('admin.kategori');
        Route::get('/supplier', [suppliercontroller::class, 'index'])->name('supplier');
        
        Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
        Route::post('/barangmasuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
        Route::get('/barangmasuk/check-serial', [BarangMasukController::class, 'checkSerial'])->name('barang-masuk.check-serial');
        Route::get('/barangmasuk/check-barang-name', [BarangMasukController::class, 'checkBarangName'])->name('barang-masuk.check-barang-name');
        Route::put('/barangmasuk/{id}', [BarangMasukController::class, 'update'])->name('barang-masuk.update');
        Route::delete('/barangmasuk/{id}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.destroy');
        Route::get('/barangkeluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
        Route::get('/barangkeluar/check-serial', [BarangKeluarController::class, 'checkSerial'])->name('barang-keluar.check-serial');
        Route::post('/barangkeluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
        Route::put('/barangkeluar/{id}', [BarangKeluarController::class, 'update'])->name('barang-keluar.update');
        Route::delete('/barangkeluar/{id}', [BarangKeluarController::class, 'destroy'])->name('barang-keluar.destroy');
    });

    Route::prefix('manajer')->middleware('role:manajer')->group(function () {
        Route::get('/', [DashboardManajerController::class, 'index'])->name('dashboardmanajer');
        Route::get('/barang', [BarangManajerController::class, 'index'])->name('brgmanajer');
        Route::get('/barang/export', [BarangManajerController::class, 'export'])->name('brgmanajer.export');
    });

});