<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BarangMasukSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $barangIds = DB::table('barang')->pluck('id')->toArray();
        $supplierIds = DB::table('suppliers')->pluck('id')->toArray();
        $karyawanIds = DB::table('karyawan')->pluck('id')->toArray();

        $fallbackSupplierId = !empty($supplierIds) ? null : DB::table('suppliers')->insertGetId([
            'nama' => 'Supplier Utama',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $fallbackKaryawanId = !empty($karyawanIds) ? null : DB::table('karyawan')->insertGetId([
            'nama' => 'Admin Gudang',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Loop setiap barang agar semua memiliki transaksi barang masuk
        foreach ($barangIds as $index => $barangId) {
            $tglMasuk = $faker->dateTimeBetween('-1 years', 'now');
            $dateStr = $tglMasuk->format('Ymd');
            $sequence = str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            
            DB::table('barang_masuk')->insert([
                'kode_transaksi' => "IN-{$dateStr}-{$sequence}",
                'barang_id' => $barangId,
                'supplier_id' => !empty($supplierIds) ? $supplierIds[array_rand($supplierIds)] : $fallbackSupplierId,
                'karyawan_id' => !empty($karyawanIds) ? $karyawanIds[array_rand($karyawanIds)] : $fallbackKaryawanId,
                'tgl_masuk' => $tglMasuk->format('Y-m-d'),
                'jumlah' => $faker->numberBetween(2, 5),
            ]);
        }
    }
}
