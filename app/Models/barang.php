<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    
    public $timestamps = false; 

    protected $fillable = [
        'kategori_id',
        'nama',
        'harga',
        'deskripsi',
        'stok'
    ];

    // Relasi ke tabel kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi ke unit barang
    public function unitBarang()
    {
        return $this->hasMany(UnitBarang::class, 'barang_id');
    }
}