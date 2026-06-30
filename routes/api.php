<?php

use App\Models\Barang;
use App\Models\LowStockAlert;
use Illuminate\Support\Facades\Route;

Route::get('/low-stock-items', function () {
    $lowStockBarang = Barang::where('stok', '>', 0)
        ->where('stok', '<=', 3)
        ->get();

    foreach ($lowStockBarang as $b) {
        $exists = LowStockAlert::where('barang_id', $b->id)->exists();
        if (!$exists) {
            LowStockAlert::create([
                'barang_id' => $b->id,
                'barang_nama' => $b->nama,
                'stok' => $b->stok,
                'message' => "Stok barang '{$b->nama}' tersisa {$b->stok} unit!",
            ]);
        }
    }

    $alertBarangIds = LowStockAlert::pluck('barang_id');
    foreach ($alertBarangIds as $barangId) {
        $barang = Barang::find($barangId);
        if (!$barang || $barang->stok > 3 || $barang->stok <= 0) {
            LowStockAlert::where('barang_id', $barangId)->delete();
        }
    }

    $lowStockAlerts = LowStockAlert::orderBy('created_at', 'desc')
        ->limit(20)
        ->get()
        ->map(function ($alert) {
            return [
                'barang_id' => $alert->barang_id,
                'barang_nama' => $alert->barang_nama,
                'stok' => $alert->stok,
                'message' => $alert->message,
                'timestamp' => $alert->created_at->toISOString(),
            ];
        });

    return response()->json($lowStockAlerts);
})->middleware('auth');

Route::delete('/low-stock-items/{barangId}', function ($barangId) {
    LowStockAlert::where('barang_id', $barangId)->delete();
    return response()->json(['success' => true]);
})->middleware('auth');

Route::delete('/low-stock-items', function () {
    LowStockAlert::truncate();
    return response()->json(['success' => true]);
})->middleware('auth');
