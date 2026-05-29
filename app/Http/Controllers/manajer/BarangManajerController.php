<?php

namespace App\Http\Controllers\manajer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\BarangAdminController;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BarangManajerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $query = Barang::with(['kategori', 'unitBarang'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($subQuery) use ($search) {
                    $subQuery->where('nama', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->when($kategori, function ($q) use ($kategori) {
                $q->where('kategori_id', $kategori);
            });

        $allBarang = $query->get()
            ->groupBy(function ($item) {
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
                    'unitBarang' => $group->flatMap->unitBarang->unique('id')->values(),
                ];
            })
            ->filter(function ($item) {
                return $item->stok > 0;
            })
            ->values();

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allBarang->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $barang = new LengthAwarePaginator(
            $currentItems,
            $allBarang->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        $categories = Kategori::orderBy('nama')->get();

        return view('manajer.BarangManajer', compact('barang', 'categories'));
    }

    public function export(Request $request)
    {
        return app(BarangAdminController::class)->export($request);
    }
}
