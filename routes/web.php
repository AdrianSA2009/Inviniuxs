<?php
use App\Http\Controllers\databarang_controller;
use App\Http\Controllers\databarang1_controller;
use App\Http\Controllers\databarang2_controller;
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
use App\Http\Controllers\gambarController;
use App\Http\Controllers\listprodukController; 
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [loginController::class, 'index'])->name('login');
    Route::post('/', [loginController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [loginController::class, 'logout'])->name('logout');

    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboardadmin');
        Route::get('/barang', [BarangAdminController::class, 'index'])->name('brgadmin');
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna.index');
        Route::post('/pengguna', [PenggunaController::class, 'store'])->name('admin.pengguna.store');
        Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('admin.pengguna.update');
        Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.destroy');
        Route::get('/kategori', [kategoriController::class, 'index'])->name('kategori');
        Route::get('/supplier', [suppliercontroller::class, 'index'])->name('supplier');
        Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barang-masuk');
        Route::get('/barangkeluar', [BarangKeluarController::class, 'index'])->name('barang-keluar');
    });

    Route::prefix('manajer')->group(function () {
        Route::get('/', [DashboardManajerController::class, 'index'])->name('dashboardmanajer');
        Route::get('/barang', [BarangManajerController::class, 'index'])->name('brgmanajer');
    });

});

Route::get('/barang', [databarang_controller::class, 'tampilkan']);
Route::get('/barang1', [databarang1_controller::class, 'tampilkan']);
Route::get('/barang2', [databarang2_controller::class, 'tampilkan']);

Route::get('/praktikum1', function () {
    return view('praktikum1');
});

Route::get('/gambardrian', [gambarController::class, 'index']);
Route::get('/test', function(){
    return view('test');
});
Route::get('/listproduk', [listprodukController::class, 'index']);

Route::get('/praktikum1', function () {
    return view('praktikum1');
});