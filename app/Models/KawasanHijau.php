<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KawasanHijau extends Model
{
    protected $hashids;
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->hashids = new Hashids(config('app.key'), 10); // Menggunakan key aplikasi dan panjang ID
    }
    protected $table = 'kawasan_hijau';
    protected $fillable = [
        'nama_kawasan',
        'id_kampus',
        'geom',
        'luas',
        'jenis_vegetasi',
        'foto'
    ];

    public function getHashedIdAttribute()
    {
        return $this->hashids->encode($this->id);
    }

    public function kampus()
    {
        return $this->belongsTo(Kampus::class, 'id_kampus', 'id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
