<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class suppliercontroller extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $suppliers = Supplier::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('alamat', 'like', "%{$search}%")
                         ->orWhere('no_telp', 'like', "%{$search}%");
        })
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('admin.supplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:suppliers,nama',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:50',
        ]);

        Supplier::create($validated);

        return redirect()->route('admin.supplier.index')
                         ->with('toast_success', 'Supplier berhasil ditambahkan.');
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:suppliers,nama,' . $supplier->id,
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:50',
        ]);

        $supplier->update($validated);

        return redirect()->route('admin.supplier.index')
                         ->with('toast_success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('admin.supplier.index')
                         ->with('toast_success', 'Supplier berhasil dihapus.');
    }
}
