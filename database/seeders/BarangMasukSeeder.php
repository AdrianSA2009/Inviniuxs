<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangMasukSeeder extends Seeder
{
    public function run(): void
    {
        $barangIds = DB::table('barang')->pluck('id', 'nama');
        $supplierIds = DB::table('suppliers')->pluck('id', 'nama');
        $karyawanIds = DB::table('karyawan')->pluck('id', 'username');

        $entries = [
            [
                'kode_transaksi' => 'IN-20260520-001',
                'barang_nama' => 'Kulkas LG GN-B372SQBK 312L Inverter',
                'supplier_nama' => 'PT Sumber Makmur',
                'karyawan_username' => 'admin_gudang',
                'tgl_masuk' => '2026-05-20',
                'serials' => ['LG-2026-001', 'LG-2026-002'],
            ],
            [
                'kode_transaksi' => 'IN-20260521-001',
                'barang_nama' => 'Kompor Gas Rinnai 2 Tungku',
                'supplier_nama' => 'CV Distribusi Jaya',
                'karyawan_username' => 'manajer',
                'tgl_masuk' => '2026-05-21',
                'serials' => ['RI-2026-001', 'RI-2026-002', 'RI-2026-003'],
            ],
            [
                'kode_transaksi' => 'IN-20260522-001',
                'barang_nama' => 'Rak Besi Serbaguna 5 Susun',
                'supplier_nama' => 'UD Sumber Rejeki',
                'karyawan_username' => 'admin_gudang',
                'tgl_masuk' => '2026-05-22',
                'serials' => ['RK-2026-001', 'RK-2026-002'],
            ],
        ];

        foreach ($entries as $entry) {
            $barangId = $barangIds[$entry['barang_nama']] ?? null;
            $supplierId = $supplierIds[$entry['supplier_nama']] ?? null;
            $karyawanId = $karyawanIds[$entry['karyawan_username']] ?? null;

            if (!$barangId || !$supplierId || !$karyawanId) {
                continue;
            }

            $barangMasukId = DB::table('barang_masuk')->insertGetId([
                'kode_transaksi' => $entry['kode_transaksi'],
                'barang_id' => $barangId,
                'supplier_id' => $supplierId,
                'karyawan_id' => $karyawanId,
                'tgl_masuk' => $entry['tgl_masuk'],
                'jumlah' => count($entry['serials']),
            ]);

            foreach ($entry['serials'] as $serial) {
                DB::table('unit_barang')->insert([
                    'barang_id' => $barangId,
                    'barang_masuk_id' => $barangMasukId,
                    'serial_number' => strtoupper($serial),
                    'status' => 'tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('barang')->where('id', $barangId)->increment('stok', count($entry['serials']));
        }
    }
}
