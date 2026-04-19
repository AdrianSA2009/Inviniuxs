<?php

namespace App\Http\Controllers\manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangManajerController extends Controller
{
    public function index()
    {
        return view('manajer.BarangManajer');
    }
}
