<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DokterModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'table_dokter';
    protected $fillable = ['name', 'alamat', 'no_hp','id_poli'];

    public function poli()
    {
        return $this->belongsTo(PoliModel::class, 'id_poli');
    }

    public function jadwals()
    {
        return $this->hasMany(ModelJadwalPeriksa::class, 'id_dokter');
    }

    public function getAuthIdentifierName()
    {
        return 'no_hp';
    }

    public function getAuthIdentifier()
    {
        return $this->no_hp;
    }

}
