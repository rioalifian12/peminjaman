<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;
    protected $table = 'permintaans';
    protected $fillable = [
        'no_id',
        'name_user',
        'name_barang',
        'status',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
