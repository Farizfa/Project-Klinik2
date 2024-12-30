<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliModel extends Model
{
    use HasFactory;

    protected $table = 'table_poli';

    protected $fillable = [
        'name',
        'keterangan',
    ];

    public function doctors()
    {
        return $this->hasMany(DokterModel::class, 'id_poli');
    }
}
