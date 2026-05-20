<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}