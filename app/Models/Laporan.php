<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $fillable = [
        'kampus_id',
        'kawasan_hijau_id',
        'judul_laporan',
        'deskripsi',
        'status_laporan'
    ];

    public function kampus()
    {
        return $this->belongsTo(Kampus::class);
    }

    public function kawasanHijau()
    {
        return $this->belongsTo(KawasanHijau::class);
    }
}
