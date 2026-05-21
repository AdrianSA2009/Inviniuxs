<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriIds = DB::table('kategori')->pluck('id', 'nama');

        DB::table('barang')->insert([
            [
                'kategori_id' => $kategoriIds['Elektronik'],
                'nama' => 'Kulkas LG GN-B372SQBK 312L Inverter',
                'harga' => 7499900.00,
                'deskripsi' => 'Kulkas dua pintu dengan inverter hemat listrik dan rak fleksibel.',
                'stok' => 0,
            ],
            [
                'kategori_id' => $kategoriIds['Alat Dapur'],
                'nama' => 'Kompor Gas Rinnai 2 Tungku',
                'harga' => 1299000.00,
                'deskripsi' => 'Kompor gas dua tungku dengan api stabil dan desain modern.',
                'stok' => 0,
            ],
            [
                'kategori_id' => $kategoriIds['Furniture'],
                'nama' => 'Rak Besi Serbaguna 5 Susun',
                'harga' => 499000.00,
                'deskripsi' => 'Rak besi kuat untuk gudang, kantor, atau rumah.',
                'stok' => 0,
            ],
        ]);
    }
}
