<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamen';
    protected $fillable = [
        'no_id',
        'name_user',
        'kode_barang',
        'name_barang',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];
}
