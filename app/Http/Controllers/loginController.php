<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
    
            if (Auth::check()) {
                if (Auth::user()->role === 'admin_gudang') {
                    return redirect('/admin/');
                } elseif (Auth::user()->role === 'manajer') {
                    return redirect('/manajer/');
                }
            }
    
            return redirect()->intended('/');
        }
    
        return back()->with('loginError', 'Username atau password yang Anda masukkan salah.')->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}