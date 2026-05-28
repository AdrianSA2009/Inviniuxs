<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\UnitBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with(['barang.kategori', 'karyawan'])->get();
        $barang = Barang::with('kategori')->get();

        return view('admin.barangkeluar', compact('barangKeluar', 'barang'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required|exists:barang,id',
            'tgl_keluar' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ], [
            'barang_id.required' => 'Pilih barang terlebih dahulu',
            'tgl_keluar.required' => 'Tanggal keluar harus diisi',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.min' => 'Jumlah minimal harus 1',
        ]);

        $validator->after(function ($validator) use ($request) {
            $barang = Barang::find($request->barang_id);
            if ($barang && $request->jumlah > $barang->stok) {
                $validator->errors()->add('jumlah', 'Stok tidak cukup! Stok tersedia: ' . $barang->stok);
            }
        });

        $validator->validate();

        DB::beginTransaction();

        try {
            $barang = Barang::findOrFail($request->barang_id);

            $barangKeluar = BarangKeluar::create([
                'barang_id' => $request->barang_id,
                'user_id' => Auth::id(),
                'tgl_keluar' => $request->tgl_keluar,
                'jumlah' => $request->jumlah,
            ]);

            // Kurangi stok barang
            $barang->stok -= $request->jumlah;
            $barang->save();

            // Update status unit barang dari tersedia menjadi keluar
            $unitBarangKeluar = UnitBarang::where('barang_id', $request->barang_id)
                ->where('status', 'tersedia')
                ->limit($request->jumlah)
                ->get();

            foreach ($unitBarangKeluar as $unit) {
                $unit->status = 'keluar';
                $unit->save();
            }

            DB::commit();

            return redirect()->route('barang-keluar.index')
                ->with('toast_success', 'Transaksi barang keluar berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'barang_id' => 'required|exists:barang,id',
            'tgl_keluar' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ], [
            'barang_id.required' => 'Pilih barang terlebih dahulu',
            'tgl_keluar.required' => 'Tanggal keluar harus diisi',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.min' => 'Jumlah minimal harus 1',
        ]);

        $validator->after(function ($validator) use ($request, $barangKeluar) {
            $barang = Barang::find($request->barang_id);
            $oldJumlah = $barangKeluar->jumlah;
            $newJumlah = $request->jumlah;
            $delta = $newJumlah - $oldJumlah;

            if ($barang && $delta > 0 && $delta > $barang->stok) {
                $validator->errors()->add('jumlah', 'Stok tidak cukup untuk penambahan! Stok tersedia: ' . $barang->stok);
            }
        });

        $validator->validate();

        DB::beginTransaction();

        try {
            $oldBarang = $barangKeluar->barang;
            $oldJumlah = $barangKeluar->jumlah;
            $newJumlah = $request->jumlah;
            $delta = $newJumlah - $oldJumlah;

            $newBarang = Barang::findOrFail($request->barang_id);

            // Jika barang berbeda
            if ($oldBarang->id !== $newBarang->id) {
                // Kembalikan stok barang lama
                $oldBarang->stok += $oldJumlah;
                $oldBarang->save();

                // Update status unit barang lama menjadi tersedia
                UnitBarang::where('barang_id', $oldBarang->id)
                    ->where('status', 'keluar')
                    ->limit($oldJumlah)
                    ->update(['status' => 'tersedia']);

                // Kurangi stok barang baru
                $newBarang->stok -= $newJumlah;
                $newBarang->save();

                // Update status unit barang baru menjadi keluar
                UnitBarang::where('barang_id', $newBarang->id)
                    ->where('status', 'tersedia')
                    ->limit($newJumlah)
                    ->update(['status' => 'keluar']);
            } else {
                // Barang sama, hanya ada perubahan jumlah
                if ($delta !== 0) {
                    $newBarang->stok -= $delta;
                    $newBarang->save();

                    if ($delta > 0) {
                        // Tambah unit yang keluar
                        UnitBarang::where('barang_id', $newBarang->id)
                            ->where('status', 'tersedia')
                            ->limit($delta)
                            ->update(['status' => 'keluar']);
                    } else {
                        // Kurangi unit yang keluar (kembalikan ke tersedia)
                        UnitBarang::where('barang_id', $newBarang->id)
                            ->where('status', 'keluar')
                            ->limit(abs($delta))
                            ->update(['status' => 'tersedia']);
                    }
                }
            }

            $barangKeluar->update([
                'barang_id' => $request->barang_id,
                'tgl_keluar' => $request->tgl_keluar,
                'jumlah' => $newJumlah,
            ]);

            DB::commit();

            return redirect()->route('barang-keluar.index')
                ->with('toast_success', 'Transaksi barang keluar berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'gagal memperbarui transaksi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        DB::beginTransaction();

        try {
            $barang = $barangKeluar->barang;
            $jumlah = $barangKeluar->jumlah;

            // Kembalikan stok barang
            $barang->stok += $jumlah;
            $barang->save();

            // Update status unit barang dari keluar menjadi tersedia
            UnitBarang::where('barang_id', $barang->id)
                ->where('status', 'keluar')
                ->limit($jumlah)
                ->update(['status' => 'tersedia']);

            $barangKeluar->delete();

            DB::commit();

            return redirect()->route('barang-keluar.index')
                ->with('toast_success', 'Transaksi barang keluar berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}
