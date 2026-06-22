<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:karyawan,username,' . $user->id,
            'email' => 'required|email|max:255|unique:karyawan,email,' . $user->id,
        ], [
            'nama.required' => 'Nama harus diisi.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah digunakan oleh pengguna lain.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui.',
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama harus diisi.',
            'password.required' => 'Password baru harus diisi.',
            'password.min' => 'Password baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'errors' => ['current_password' => ['Password lama tidak sesuai.']],
            ], 422);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah.',
        ]);
    }
}
