<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Karyawan extends Authenticatable
{
    use HasFactory;

    protected $table = 'karyawan';

    public $timestamps = false; 

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
    ];
    
    protected $hidden = [
        'password',
    ];
}