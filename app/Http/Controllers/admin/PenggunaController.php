<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan; // Import model Karyawan
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    // Tampilkan Data
    public function index()
    {
        $pengguna = Karyawan::all();
        return view('admin.datapengguna', compact('pengguna'));
    }

    // Tambah Data
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:karyawan,username',
            'password' => 'required|string|min:6',
            // UBAH VALIDASI ROLE DI SINI
            'role' => 'required|in:admin_gudang,manajer', 
        ], [
            'username.unique' => 'Username ini sudah terdaftar!',
        ]);

        Karyawan::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.pengguna.index')->with('toast_success', 'Data Pengguna berhasil ditambahkan!');
    }

    // Edit Data
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('karyawan')->ignore($karyawan->id),
            ],
            'password' => 'nullable|string|min:6',
            // UBAH VALIDASI ROLE DI SINI
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
            $data['password'] = Hash::make($request->password);
        }

        $karyawan->update($data);

        return redirect()->route('admin.pengguna.index')->with('toast_success', 'Data Pengguna berhasil diperbarui!');
    }

    // Hapus Data
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.pengguna.index')->with('toast_success', 'Data Pengguna berhasil dihapus!');
    }
}