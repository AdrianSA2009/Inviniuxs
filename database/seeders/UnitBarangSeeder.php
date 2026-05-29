<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UnitBarangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        // Ambil semua data barang masuk hasil dari seeder sebelumnya
        $masukRows = DB::table('barang_masuk')->get();

        foreach ($masukRows as $index => $masuk) {
            $jumlahUnit = $masuk->jumlah;

            // Buat unit sebanyak 'jumlah' yang tercatat di tabel barang_masuk
            for ($j = 0; $j < $jumlahUnit; $j++) {
                DB::table('unit_barang')->insert([
                    'barang_id' => $masuk->barang_id,
                    'barang_masuk_id' => $masuk->id,
                    'serial_number' => 'SN' . strtoupper(Str::random(6)) . ($index + 1) . ($j + 1),
                ]);
            }

            // Tambahkan stok pada master barang sesuai dengan jumlah unit yang baru saja dibuat
            DB::table('barang')
                ->where('id', $masuk->barang_id)
                ->increment('stok', $jumlahUnit);
        }
    }
}
