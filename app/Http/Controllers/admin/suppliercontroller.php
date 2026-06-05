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
        $validated = $request->validate($this->validationRules(), $this->validationMessages());

        Supplier::create($validated);

        return redirect()->route('admin.supplier.index')
                         ->with('toast_success', 'Supplier berhasil ditambahkan.');
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate($this->validationRules($supplier->id), $this->validationMessages());

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

    private function validationRules($supplierId = null): array
    {
        return [
            'nama' => 'required|string|max:255|unique:suppliers,nama' . ($supplierId ? ",{$supplierId}" : ''),
            'alamat' => 'required|string',
            'no_telp' => ['required', 'string', 'regex:/^08[0-9]{8,12}$/'],
        ];
    }

    private function validationMessages(): array
    {
        return [
            'nama.unique' => 'Supplier telah ditambahkan',
            'no_telp.regex' => 'No. HP tidak valid. Harus dimulai dengan 08 dan terdiri dari 10-14 angka.',
            'no_telp.required' => 'No. HP wajib diisi.',
        ];
    }
}
