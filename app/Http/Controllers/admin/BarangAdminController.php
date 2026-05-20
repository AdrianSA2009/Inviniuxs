<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang; // Pastikan Model di-import

class BarangAdminController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();

        return view('admin.BarangAdmin', compact('barang'));
    }
}