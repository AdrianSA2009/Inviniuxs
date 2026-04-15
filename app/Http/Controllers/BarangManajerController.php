<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangManajerController extends Controller
{
    public function index()
    {
        return view('BarangManajer');
    }
}
