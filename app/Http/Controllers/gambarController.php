<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class gambarController extends Controller
{
    public function index()
    {
        return view('gambar_adrian');
    }
}
