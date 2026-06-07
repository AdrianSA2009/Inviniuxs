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
            })
            ->orWhereHas('karyawan', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        })
        ->with(['barang.kategori', 'karyawan', 'user', 'unitBarang.barang']) 
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
            'serial_number.*' => 'required|string|exists:unit_barang,serial_number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data tidak lengkap atau Serial Number tidak valid.');
        }

        DB::beginTransaction();

        try {
            $serialNumbers = $request->input('serial_number');
            $units = UnitBarang::whereIn('serial_number', $serialNumbers)
                               ->whereNull('barang_keluar_id')
                               ->get();

            if ($units->count() != count($serialNumbers)) {
                return redirect()->back()->with('error', 'Beberapa unit sudah tidak tersedia atau tidak valid.');
            }

            $dateStr = date('Ymd', strtotime($request->tgl_keluar));
            $randomSeq = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
            
            $barangKeluar = new BarangKeluar();
            $barangKeluar->kode_transaksi = "OUT-{$dateStr}-{$randomSeq}";
            $barangKeluar->barang_id = $units->first()->barang_id; 
            $barangKeluar->user_id = Auth::id(); 
            $barangKeluar->penerima = $request->penerima;
            $barangKeluar->jumlah = $units->count();
            $barangKeluar->tgl_keluar = $request->tgl_keluar;
            $barangKeluar->save();

            $groupedUnits = $units->groupBy('barang_id');
            foreach ($groupedUnits as $barangId => $group) {
                $b = Barang::find($barangId);
                if ($b) {
                    $b->stok -= $group->count();
                    $b->save();
                }

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
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
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
        ]);
        
        $validator->validate();

        $serialNumbers = collect($request->input('serial_number', []))
            ->map(fn($sn) => strtoupper(trim($sn)))
            ->filter()
            ->unique()
            ->all();

        $unitsCheck = UnitBarang::whereIn('serial_number', $serialNumbers)->get();

        if ($unitsCheck->count() !== count($serialNumbers)) {
            return redirect()->back()->with('error', 'Beberapa serial number tidak ditemukan dalam sistem.');
        }

        $invalidUnits = $unitsCheck->filter(function($unit) use ($barangKeluar) {
            return $unit->barang_keluar_id !== null && $unit->barang_keluar_id !== $barangKeluar->id;
        });

        if ($invalidUnits->isNotEmpty()) {
            return redirect()->back()->with('error', 'Beberapa unit tidak tersedia (sudah keluar).');
        }

        DB::beginTransaction();

        try {
            // 1. KEMBALIKAN STOK LAMA 
            $oldUnits = UnitBarang::where('barang_keluar_id', $barangKeluar->id)->get();
            foreach ($oldUnits->groupBy('barang_id') as $bId => $group) {
                Barang::where('id', $bId)->increment('stok', $group->count());
            }

            // Lepaskan unit menggunakan Mass Update (Menghindari bug memori Laravel)
            UnitBarang::where('barang_keluar_id', $barangKeluar->id)->update([
                'barang_keluar_id' => null
            ]);

            // 2. UPDATE TRANSAKSI UTAMA
            $barangKeluar->penerima = $request->penerima;
            $barangKeluar->tgl_keluar = $request->tgl_keluar;
            $barangKeluar->barang_id = $unitsCheck->first()->barang_id; 
            $barangKeluar->jumlah = count($serialNumbers);
            $barangKeluar->save();

            // 3. POTONG STOK BARU
            foreach ($unitsCheck->groupBy('barang_id') as $bId => $group) {
                Barang::where('id', $bId)->decrement('stok', $group->count());
            }

            // Pasangkan ulang unit menggunakan Mass Update
            UnitBarang::whereIn('serial_number', $serialNumbers)->update([
                'barang_keluar_id' => $barangKeluar->id
            ]);

            DB::commit();

            return redirect()->route('barang-keluar.index')
                ->with('toast_success', 'Transaksi barang keluar berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui transaksi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        DB::beginTransaction();

        try {
            $units = UnitBarang::where('barang_keluar_id', $id)->get();

            if ($units->count() > 0) {
                // Kembalikan stok berdasarkan jenis barang masing-masing unit yang dihapus
                $groupedUnits = $units->groupBy('barang_id');
                foreach ($groupedUnits as $bId => $group) {
                    $b = Barang::find($bId);
                    if ($b) {
                        $b->stok += $group->count();
                        $b->save();
                    }
                }

                // Lepaskan relasi unit
                foreach ($units as $u) {
                    $u->barang_keluar_id = null;
                    $u->save();
                }
            } else {
                // Fallback (jika data unit kosong)
                $barang = $barangKeluar->barang;
                if ($barang) {
                    $barang->stok += $barangKeluar->jumlah;
                    $barang->save();
                }
            }

            $barangKeluar->delete();

            DB::commit();

            return redirect()->route('barang-keluar.index')
                ->with('toast_success', 'Transaksi barang keluar berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}
