<?php
use App\Http\Controllers\databarang_controller;
use App\Http\Controllers\databarang1_controller;
use App\Http\Controllers\databarang2_controller;
use App\Http\Controllers\barangmasuk_controller;
use App\Http\Controllers\barangkeluar_controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', [databarang_controller::class, 'tampilkan']);
Route::get('/barang1', [databarang1_controller::class, 'tampilkan']);
Route::get('/barang2', [databarang2_controller::class, 'tampilkan']);
Route::get('/barangmasuk', [barangmasuk_controller::class, 'index']);
Route::get('/barangkeluar', [barangkeluar_controller::class, 'index']);
