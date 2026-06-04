<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';

    public $timestamps = false;

    protected $fillable = ['nama', 'alamat', 'no_telp'];

    public function barangMasuk()
    {
        return $this->hasMany(\App\Models\BarangMasuk::class, 'supplier_id');
    }
}