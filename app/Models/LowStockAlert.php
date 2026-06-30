<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LowStockAlert extends Model
{
    protected $fillable = [
        'barang_id',
        'barang_nama',
        'stok',
        'message',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
