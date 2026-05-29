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
    public function index(Request $request)
    {
        $search = $request->input('search');

        $barangKeluar = BarangKeluar::when($search, function ($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('kode_transaksi', 'like', "%{$search}%")
                  ->orWhere('penerima', 'like', "%{$search}%");
            });
        })
        ->with(['barang.kategori', 'karyawan', 'unitBarang'])
        ->orderBy('tgl_keluar', 'desc')
        ->paginate(10)
        ->withQueryString();

        $barang = Barang::with('kategori')->get();
        $karyawan = \App\Models\User::all();

        return view('admin.barangkeluar', compact('barangKeluar', 'barang', 'karyawan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penerima' => 'required|string|max:255',
            'tgl_keluar' => 'required|date',
            'serial_number' => 'required|array|min:1',
            'serial_number.*' => 'required|string',
        ], [
            'penerima.required' => 'Penerima harus diisi',
            'tgl_keluar.required' => 'Tanggal keluar harus diisi',
            'serial_number.required' => 'Daftar unit tidak boleh kosong',
        ]);

        $validator->validate();

        $serialNumbers = collect($request->input('serial_number', []))
            ->map(fn($sn) => strtoupper(trim($sn)))
            ->filter()
            ->unique()
            ->all();

        $units = UnitBarang::whereIn('serial_number', $serialNumbers)->get();

        if ($units->count() !== count($serialNumbers)) {
            return redirect()->back()->with('error', 'Beberapa serial number tidak ditemukan dalam sistem.');
        }

        $unavailable = $units->filter(fn($unit) => $unit->barang_keluar_id !== null);
        if ($unavailable->isNotEmpty()) {
            return redirect()->back()->with('error', 'Beberapa unit tidak tersedia (mungkin sudah keluar atau rusak).');
        }

        DB::beginTransaction();

        try {
            $tanggal = date('Ymd', strtotime($request->tgl_keluar));
            $hitungTransaksi = BarangKeluar::where('tgl_keluar', $request->tgl_keluar)->distinct('kode_transaksi')->count('kode_transaksi') + 1;
            $kodeTransaksi = 'OUT-' . $tanggal . '-' . str_pad($hitungTransaksi, 3, '0', STR_PAD_LEFT);

            $groupedUnits = $units->groupBy('barang_id');

            foreach ($groupedUnits as $barangId => $group) {
                $jumlah = $group->count();
                
                $barangKeluar = BarangKeluar::create([
                    'kode_transaksi' => $kodeTransaksi,
                    'barang_id' => $barangId,
                    'user_id' => Auth::id() ?? 1,
                    'penerima' => $request->penerima,
                    'tgl_keluar' => $request->tgl_keluar,
                    'jumlah' => $jumlah,
                ]);

                $barang = Barang::find($barangId);
                $barang->stok -= $jumlah;
                $barang->save();

                foreach ($group as $unit) {
                    $unit->barang_keluar_id = $barangKeluar->id;
                    $unit->save();
                }
            }

            DB::commit();

            return redirect()->route('barang-keluar.index')
                ->with('toast_success', 'Transaksi barang keluar berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function checkSerial(Request $request)
    {
        $serial = strtoupper(trim($request->query('serial_number', '')));
        $barangKeluarId = $request->query('barang_keluar_id');

        if ($serial === '') {
            return response()->json(['valid' => false, 'message' => 'Serial number kosong']);
        }

        $unit = UnitBarang::with('barang')->where('serial_number', $serial)->first();

        if (!$unit) {
            return response()->json(['valid' => false, 'message' => 'Unit tidak ditemukan']);
        }

        if ($unit->barang_keluar_id !== null && $unit->barang_keluar_id != $barangKeluarId) {
            return response()->json(['valid' => false, 'message' => 'Unit tidak tersedia (sudah keluar)']);
        }

        return response()->json([
            'valid' => true, 
            'nama_barang' => $unit->barang->nama ?? '-',
            'unit_id' => $unit->id
        ]);
    }

    public function update(Request $request, $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'penerima' => 'required|string|max:255',
            'tgl_keluar' => 'required|date',
            'serial_number' => 'required|array|min:1',
            'serial_number.*' => 'required|string',
        ], [
            'penerima.required' => 'Penerima harus diisi',
            'tgl_keluar.required' => 'Tanggal keluar harus diisi',
            'serial_number.required' => 'Daftar unit tidak boleh kosong',
        ]);

        $validator->validate();

        $serialNumbers = collect($request->input('serial_number', []))
            ->map(fn($sn) => strtoupper(trim($sn)))
            ->filter()
            ->unique()
            ->all();

        $units = UnitBarang::whereIn('serial_number', $serialNumbers)->get();

        if ($units->count() !== count($serialNumbers)) {
            return redirect()->back()->with('error', 'Beberapa serial number tidak ditemukan dalam sistem.');
        }

        $invalidUnits = $units->filter(function($unit) use ($barangKeluar) {
            return $unit->barang_keluar_id !== null && $unit->barang_keluar_id !== $barangKeluar->id;
        });

        if ($invalidUnits->isNotEmpty()) {
            return redirect()->back()->with('error', 'Beberapa unit tidak tersedia (sudah keluar di transaksi lain atau rusak).');
        }

        DB::beginTransaction();

        try {
            $oldUnits = UnitBarang::where('barang_keluar_id', $barangKeluar->id)->get();
            $oldBarangId = $barangKeluar->barang_id;
            $kodeTransaksi = $barangKeluar->kode_transaksi;
            
            $oldBarang = Barang::find($oldBarangId);
            if ($oldBarang) {
                $oldBarang->stok += $oldUnits->count();
                $oldBarang->save();
            }

            foreach ($oldUnits as $u) {
                $u->barang_keluar_id = null;
                $u->save();
            }

            $groupedUnits = $units->groupBy('barang_id');
            $isFirst = true;

            foreach ($groupedUnits as $barangId => $group) {
                $jumlah = $group->count();
                $b = Barang::find($barangId);
                $b->stok -= $jumlah;
                $b->save();

                if ($isFirst) {
                    $barangKeluar->update([
                        'kode_transaksi' => $kodeTransaksi,
                        'barang_id' => $barangId,
                        'user_id' => Auth::id() ?? 1,
                        'penerima' => $request->penerima,
                        'tgl_keluar' => $request->tgl_keluar,
                        'jumlah' => $jumlah,
                    ]);
                    $currentBkId = $barangKeluar->id;
                    $isFirst = false;
                } else {
                    $newBk = BarangKeluar::create([
                        'kode_transaksi' => $kodeTransaksi,
                        'barang_id' => $barangId,
                        'user_id' => Auth::id() ?? 1,
                        'penerima' => $request->penerima,
                        'tgl_keluar' => $request->tgl_keluar,
                        'jumlah' => $jumlah,
                    ]);
                    $currentBkId = $newBk->id;
                }

                foreach ($group as $u) {
                    $u->barang_keluar_id = $currentBkId;
                    $u->save();
                }
            }

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
            $units = UnitBarang::where('barang_keluar_id', $id)->get();
            $barang = $barangKeluar->barang;

            $jumlahToRestore = $units->count() > 0 ? $units->count() : $barangKeluar->jumlah;

            if ($barang) {
                $barang->stok += $jumlahToRestore;
                $barang->save();
            }

            if ($units->count() > 0) {
                foreach ($units as $u) {
                    $u->barang_keluar_id = null;
                    $u->save();
                }
            } else {
                UnitBarang::where('barang_id', $barang->id)
                    ->whereNotNull('barang_keluar_id')
                    ->limit($jumlahToRestore)
                    ->update(['barang_keluar_id' => null]);
            }

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
