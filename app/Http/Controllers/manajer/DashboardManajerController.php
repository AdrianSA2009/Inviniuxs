<?php

namespace App\Http\Controllers\manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardManajerController extends Controller
{
    public function index()
    {
        return view('manajer.DashboardManajer');
    }
}
