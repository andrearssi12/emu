<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KawasanHijau extends Model
{
    use HasFactory;

    protected $table = 'kawasan_hijau';
    protected $fillable = [
        'nama_kawasan',
        'kampus_id',
        'geom',
        'luas',
        'jenis_vegetasi',
        'foto'
    ];

    public function kampus()
    {
        return $this->belongsTo(Kampus::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
