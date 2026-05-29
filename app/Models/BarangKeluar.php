<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $fillable = [
        'kode_transaksi',
        'barang_id',
        'user_id',
        'penerima',
        'tgl_keluar',
        'jumlah'
    ];
    
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function unitBarang()
    {
        return $this->hasMany(UnitBarang::class, 'barang_keluar_id');
    }
}
