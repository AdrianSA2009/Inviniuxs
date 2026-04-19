<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class listprodukController extends Controller
{
    public function index() {
        $data = [
            ['id' => 1, 'produk' => 'Laptop'],
            ['id' => 2, 'produk' => 'Mouse'],
        ];
        return view('list_product', compact('data'));
    }
}
