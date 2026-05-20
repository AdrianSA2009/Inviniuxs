<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['nama' => 'Elektronik'],
            ['nama' => 'Alat Dapur'],
            ['nama' => 'Furniture'],
            ['nama' => 'Aksesoris'],
        ]);
    }
}
