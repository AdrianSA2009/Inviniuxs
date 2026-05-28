<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count(); 
        $totalBarangMasuk = BarangMasuk::sum('jumlah') ?? 0;
        $totalBarangKeluar = DB::table('barang_keluar')->sum('jumlah') ?? 0; 
        $totalSupplier = Supplier::count();

        $barangMasukAktivitas = BarangMasuk::with('supplier')
            ->orderBy('tgl_masuk', 'desc')
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'kode' => $item->kode_transaksi,
                    'nama_supplier' => $item->supplier->nama ?? '-',
                    'tipe' => 'Barang Masuk',
                    'tanggal' => Carbon::parse($item->tgl_masuk)->translatedFormat('d F Y, H:i'),
                    'raw_date' => $item->tgl_masuk
                ];
            });

        $barangKeluarAktivitas = DB::table('barang_keluar')
            ->orderBy('tgl_keluar', 'desc')
            ->take(3)
            ->get()
            ->map(function ($item) {
                
                return [
                    'kode' => $item->kode_transaksi,
                    'nama_supplier' => '-', 
                    'tipe' => 'Barang Keluar',
                    'tanggal' => Carbon::parse($item->tgl_keluar)->translatedFormat('d F Y, H:i'),
                    'raw_date' => $item->tgl_keluar
                ];
            });

        $aktivitasTerakhir = $barangMasukAktivitas->concat($barangKeluarAktivitas)
            ->sortByDesc('raw_date')
            ->take(3);

        return view('admin.DashboardAdmin', compact(
            'totalBarang', 
            'totalBarangMasuk', 
            'totalBarangKeluar', 
            'totalSupplier', 
            'aktivitasTerakhir'
        ));
    }
}