<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitBarang extends Model
{
    protected $table = 'unit_barang';
    protected $fillable = ['barang_id', 'barang_masuk_id', 'serial_number', 'status'];
    
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