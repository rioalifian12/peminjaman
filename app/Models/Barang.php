<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $fillable = [
        'kode_barang',
        'name',
        'tipe',
        'tahun',
        'status',
        'image',
        'kondisi',
    ];
}
