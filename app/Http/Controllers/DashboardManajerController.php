<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardManajerController extends Controller
{
    public function index()
    {
        return view('DashboardManajer');
    }
}
