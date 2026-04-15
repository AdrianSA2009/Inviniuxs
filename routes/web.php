<?php
use App\Http\Controllers\databarang_controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', [databarang_controller::class, 'tampilkan']);
