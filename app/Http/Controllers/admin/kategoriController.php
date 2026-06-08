<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $kategoris = Kategori::when($search, function ($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        })
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('admin.kategori', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama'
        ], [
            'nama.required' => 'Nama kategori harus diisi',
            'nama.unique' => 'Nama kategori sudah ada, silakan gunakan nama lain!'
        ]);

        Kategori::create($validated);
        return redirect()->route('admin.kategori.index')->with('toast_success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama,' . $kategori->id
        ], [
            'nama.required' => 'Nama kategori harus diisi',
            'nama.unique' => 'Nama kategori sudah digunakan oleh data lain!'
        ]);

        $kategori->update($validated);
        return redirect()->route('admin.kategori.index')->with('toast_success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
    
        // Cek jika kategori masih dipakai
        if ($kategori->barang()->exists()) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan pada data barang/transaksi.');
        }
    
        $kategori->delete();
    
        return redirect()->route('admin.kategori.index')
                         ->with('toast_success', 'Kategori berhasil dihapus!');
    }
}

