<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'nama' => 'PT Sumber Makmur',
                'alamat' => 'Jl. Industri No. 12, Jakarta',
                'no_telp' => '021-12345678',
            ],
            [
                'nama' => 'CV Distribusi Jaya',
                'alamat' => 'Jl. Pintu Air Raya No. 5, Bandung',
                'no_telp' => '022-87654321',
            ],
            [
                'nama' => 'UD Sumber Rejeki',
                'alamat' => 'Jl. Raya Solo No. 88, Yogyakarta',
                'no_telp' => '0274-112233',
            ],
        ]);
    }
}
