<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = [
        'city_id',
        'city_name',
        'prov_id',
    ];
}
