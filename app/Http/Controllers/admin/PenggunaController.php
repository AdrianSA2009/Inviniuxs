<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    // Tampilkan Data
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');
    
        $pengguna = User::when($search, function ($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        })
        ->when($role, function ($query, $role) {
            return $query->where('role', $role);
        })
        ->paginate(10)
        ->withQueryString();
        
        return view('admin.datapengguna', compact('pengguna'));
    }

   // Tambah Data
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:karyawan,username',
            'password' => 'required|string',
            'role' => 'required|in:admin_gudang,manajer', 
        ], [
            'username.unique' => 'Username ini sudah terdaftar!',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.pengguna.index')->with('toast_success', 'Data Pengguna berhasil ditambahkan!');
    }

    // Edit Data
    public function update(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('karyawan')->ignore($karyawan->id),
            ],
            'password' => 'nullable|string',
            'role' => 'required|in:admin_gudang,manajer',
        ], [
            'username.unique' => 'Username ini sudah digunakan!',
        ]);

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $karyawan->update($data);

        return redirect()->route('admin.pengguna.index')->with('toast_success', 'Data Pengguna berhasil diperbarui!');
    }

    // Hapus Data
    public function destroy($id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.pengguna.index')->with('toast_success', 'Data Pengguna berhasil dihapus!');
    }
}