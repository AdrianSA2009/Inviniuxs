<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Supplier;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with(['barang', 'supplier'])->get();
        
        $barangs = Barang::all();
        $suppliers = Supplier::all();

        return view('admin.barangmasuk', compact('barangMasuk', 'barangs', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'   => 'required',
            'supplier_id' => 'required',
            'jumlah'      => 'required|integer|min:1',
        ]);

        $tgl_masuk = now()->toDateString(); 

        
        $isDuplicate = BarangMasuk::where('barang_id', $request->barang_id)
                        ->where('supplier_id', $request->supplier_id)
                        ->where('tgl_masuk', $tgl_masuk)
                        ->exists();

        if ($isDuplicate) {
            return redirect()->back()
                ->withErrors(['unique_error' => 'Data transaksi untuk barang dan supplier tersebut sudah tercatat hari ini!'])
                ->withInput();
        }

        BarangMasuk::create([
            'barang_id'   => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'karyawan_id' => auth()->user()->id ?? 1, // Mengambil ID admin yang login atau default ke 1
            'tgl_masuk'   => $tgl_masuk,
            'jumlah'      => $request->jumlah
        ]);

        return redirect()->route('admin.barangmasuk')->with('toast_success', 'Transaksi barang masuk berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id'   => 'required',
            'supplier_id' => 'required',
            'jumlah'      => 'required|integer|min:1',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);

        $isDuplicate = BarangMasuk::where('barang_id', $request->barang_id)
                        ->where('supplier_id', $request->supplier_id)
                        ->where('tgl_masuk', $barangMasuk->tgl_masuk)
                        ->where('id', '!=', $id)
                        ->exists();

        if ($isDuplicate) {
            return redirect()->back()
                ->withErrors(['unique_error' => 'Perubahan gagal! Kombinasi data barang masuk tersebut sudah ada di sistem.'])
                ->withInput();
        }

        $barangMasuk->update([
            'barang_id'   => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'jumlah'      => $request->jumlah
        ]);

        return redirect()->route('admin.barangmasuk')->with('toast_success', 'Data transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->delete();

        return redirect()->route('admin.barangmasuk')->with('toast_success', 'Data transaksi berhasil dihapus!');
    }
}