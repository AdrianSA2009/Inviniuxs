<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('karyawan')->insert([
            [
                'nama' => 'Admin Gudang',
                'username' => 'admin_gudang',
                'password' => Hash::make('secret123'),
                'role' => 'admin_gudang',
            ],
            [
                'nama' => 'Manajer',
                'username' => 'manajer',
                'password' => Hash::make('secret123'),
                'role' => 'manajer',
            ],
        ]);
    }
}
