<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

class BarangAdminController extends Controller
{
    public function index()
    {
        // mengambil seluruh data barang dan mengelompokkannya berdasarkan nama item
        $barang = Barang::with('kategori')
            ->get()
            ->groupBy(function($item) {
                return strtolower(trim($item->nama));
            })
            ->map(function ($group) {
                $firstItem = $group->first();
                return (object) [
                    'id' => $firstItem->id,
                    'nama' => $firstItem->nama,
                    'kategori' => $firstItem->kategori,
                    'harga' => $firstItem->harga,
                    'deskripsi' => $firstItem->deskripsi,
                    'stok' => $group->sum('stok'),
                ];
            });

        return view('admin.BarangAdmin', compact('barang'));
    }
}