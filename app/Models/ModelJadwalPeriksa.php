<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelJadwalPeriksa extends Model
{
    use HasFactory;

    protected $table = 'table_jadwal_periksa';
    protected $fillable = ['id_dokter', 'hari', 'jam_mulai', 'jam_selesai', 'status'];

    public function dokter()
    {
        return $this->belongsTo(DokterModel::class, 'id_dokter');
    }

    public function scopeActive($query, $dokterId)
    {
        return $query->where('id_dokter', $dokterId)->where('status', 'aktif');
    }
}
