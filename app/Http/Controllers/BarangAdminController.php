<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangAdminController extends Controller
{
    public function index()
    {
        return view('BarangAdmin');
    }
}
