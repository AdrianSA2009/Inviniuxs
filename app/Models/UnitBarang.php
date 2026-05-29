<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitBarang extends Model
{
    use HasFactory;
    protected $table = 'unit_barang';
    protected $fillable = ['barang_id', 'barang_masuk_id', 'barang_keluar_id', 'serial_number'];
    
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class);
    }
}