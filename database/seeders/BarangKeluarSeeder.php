<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BarangKeluarSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Ambil semua data master yang dibutuhkan
        $karyawanIds = DB::table('karyawan')->pluck('id')->toArray();
        
        if (empty($karyawanIds)) {
            // Jika data karyawan kosong, buat fallback satu admin
            $karyawanIds[] = DB::table('karyawan')->insertGetId([
                'nama' => 'Admin Gudang Utama',
                'username' => 'admin_gudang',
                'password' => bcrypt('password'),
                'role' => 'admin_gudang',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        for ($i = 0; $i < 15; $i++) {
            
            $availableItems = DB::table('unit_barang')
                ->whereNull('barang_keluar_id')
                ->select('barang_id')
                ->distinct()
                ->pluck('barang_id')
                ->toArray();

            if (empty($availableItems)) {
                break;
            }

            $barangId = $availableItems[array_rand($availableItems)];

            $availableUnitIds = DB::table('unit_barang')
                ->where('barang_id', $barangId)
                ->whereNull('barang_keluar_id')
                ->pluck('id')
                ->toArray();

            if (empty($availableUnitIds)) {
                continue;
            }
            $jumlahKeluar = min(count($availableUnitIds), $faker->numberBetween(1, 3));
            
            shuffle($availableUnitIds);
            $selectedUnitIds = array_slice($availableUnitIds, 0, $jumlahKeluar);

            $tglKeluar = $faker->dateTimeBetween('-6 months', 'now');
            $dateStr = $tglKeluar->format('Ymd');
            $sequence = str_pad($i + 1, 3, '0', STR_PAD_LEFT);
            $kodeTransaksi = "OUT-{$dateStr}-{$sequence}";

            // 3. Insert data ke tabel barang_keluar
            $barangKeluarId = DB::table('barang_keluar')->insertGetId([
                'kode_transaksi' => $kodeTransaksi,
                'barang_id' => $barangId,
                'user_id' => $karyawanIds[array_rand($karyawanIds)],
                'penerima' => $faker->name,
                'jumlah' => $jumlahKeluar,
                'tgl_keluar' => $tglKeluar->format('Y-m-d'),
            ]);

            DB::table('unit_barang')
                ->whereIn('id', $selectedUnitIds)
                ->update([
                    'barang_keluar_id' => $barangKeluarId,
                ]);

            DB::table('barang')
                ->where('id', $barangId)
                ->decrement('stok', $jumlahKeluar);
        }
    }
}