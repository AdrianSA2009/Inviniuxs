<?php

namespace App\Events;

use App\Models\Barang;
use App\Models\UnitBarang;
use App\Models\LowStockAlert;

trait HasStockAlert
{
    /**
     * Sinkronisasi stok dari jumlah unit aktual (bukan counter manual)
     */
    private function syncStok($barangId)
    {
        $b = Barang::find($barangId);
        if (!$b) return null;

        $b->stok = UnitBarang::where('barang_id', $barangId)
            ->whereNull('barang_keluar_id')
            ->count();
        $b->save();

        return $b;
    }

    /**
     * Cek stok rendah & buat/hapus alert sesuai kondisi
     */
    private function checkAndCreateLowStockAlert($barang)
    {
        if ($barang->stok <= 3 && $barang->stok > 0) {
            broadcast(new LowStockNotification($barang->id, $barang->nama, $barang->stok));

            LowStockAlert::where('barang_id', $barang->id)
                ->where('is_read', false)
                ->delete();

            LowStockAlert::create([
                'barang_id' => $barang->id,
                'barang_nama' => $barang->nama,
                'stok' => $barang->stok,
                'message' => "Stok barang '{$barang->nama}' tersisa {$barang->stok} unit!",
            ]);
        } else if ($barang->stok > 3) {
            $this->clearLowStockAlert($barang->id);
        }
    }

    /**
     * Hapus alert low stock yang belum dibaca
     */
    private function clearLowStockAlert($barangId)
    {
        LowStockAlert::where('barang_id', $barangId)
            ->where('is_read', false)
            ->delete();
    }
}
