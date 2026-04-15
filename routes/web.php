<?php
use App\Http\Controllers\databarang_controller;
use App\Http\Controllers\databarang1_controller;
use App\Http\Controllers\databarang2_controller;
use App\Http\Controllers\barangmasuk_controller;
use App\Http\Controllers\barangkeluar_controller;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\suppliercontroller;
use Illuminate\Support\Facades\Route;

route::get('/', [loginController::class, 'index']);
route::get('/kategori', [kategoriController::class, 'index']);
route::get('/supplier', [suppliercontroller::class, 'index']);
Route::get('/barang', [databarang_controller::class, 'tampilkan']);
Route::get('/barang1', [databarang1_controller::class, 'tampilkan']);
Route::get('/barang2', [databarang2_controller::class, 'tampilkan']);
Route::get('/barangmasuk', [barangmasuk_controller::class, 'index']);
Route::get('/barangkeluar', [barangkeluar_controller::class, 'index']);
