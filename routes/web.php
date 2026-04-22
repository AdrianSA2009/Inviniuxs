<?php
use App\Http\Controllers\databarang_controller;
use App\Http\Controllers\databarang1_controller;
use App\Http\Controllers\databarang2_controller;
use App\Http\Controllers\barangmasuk_controller;
use App\Http\Controllers\barangkeluar_controller;
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

route::get('/', [loginController::class, 'index'])->name('logout');
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboardadmin');
    Route::get('/barang', [BarangAdminController::class, 'index'])->name('brgadmin');
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::get('/kategori', [kategoriController::class, 'index'])->name('kategori');
    Route::get('/supplier', [suppliercontroller::class, 'index'])->name('supplier');
    Route::get('/barangmasuk', [barangmasuk_controller::class, 'index'])->name('barang-masuk');
    Route::get('/barangkeluar', [barangkeluar_controller::class, 'index'])->name('barang-keluar');
});

Route::prefix('manajer')->group(function () {
    Route::get('/dashboard', [DashboardManajerController::class, 'index'])->name('dashboardmanajer');
    Route::get('/barang', [BarangManajerController::class, 'index'])->name('brgmanajer');
});

Route::get('/barang', [databarang_controller::class, 'tampilkan']);
Route::get('/barang1', [databarang1_controller::class, 'tampilkan']);
Route::get('/barang2', [databarang2_controller::class, 'tampilkan']);
Route::get('/barangmasuk', [barangmasuk_controller::class, 'index']);
Route::get('/barangkeluar', [barangkeluar_controller::class, 'index']);

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