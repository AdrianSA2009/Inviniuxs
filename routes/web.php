<?php
use App\Http\Controllers\databarang_controller;
use App\Http\Controllers\databarang1_controller;
use App\Http\Controllers\databarang2_controller;
use App\Http\Controllers\barangmasuk_controller;
use App\Http\Controllers\barangkeluar_controller;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\suppliercontroller;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\BarangAdminController;
use App\Http\Controllers\DashboardManajerController;
use App\Http\Controllers\BarangManajerController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\gambarController;
use Illuminate\Support\Facades\Route;

route::get('/', [loginController::class, 'index']);
route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])->name('dashboardadmin');
route::get('/dashboardmanajer', [DashboardManajerController::class, 'index'])->name('dashboardmanajer');
route::get('/barangadmin', [BarangAdminController::class, 'index'])->name('brgadmin');
route::get('/barangmanajer', [BarangManajerController::class, 'index'])->name('brgmanajer');
route::get('/datapengguna', [PenggunaController::class, 'index'])->name('pengguna');
route::get('/kategori', [kategoriController::class, 'index'])->name('kategori');
route::get('/supplier', [suppliercontroller::class, 'index'])->name('supplier');
Route::get('/barang', [databarang_controller::class, 'tampilkan']);
Route::get('/barang1', [databarang1_controller::class, 'tampilkan']);
Route::get('/barang2', [databarang2_controller::class, 'tampilkan']);
Route::get('/barangmasuk', [barangmasuk_controller::class, 'index'])->name('barang-masuk');
Route::get('/barangkeluar', [barangkeluar_controller::class, 'index'])->name('barang-keluar');
Route::get('/gambardrian', [gambarController::class, 'index']);
Route::get('/test', function(){
    return view('test');
});