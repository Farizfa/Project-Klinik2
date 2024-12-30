<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatModel extends Model
{
    use HasFactory;

    protected $table = 'table_obat';

    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];
}
