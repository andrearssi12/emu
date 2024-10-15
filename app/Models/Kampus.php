<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kampus extends Model
{
    protected $hashids;
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->hashids = new Hashids(config('app.key'), 10); // Menggunakan key aplikasi dan panjang ID
    }

    protected $table = 'kampus';
    protected $fillable = [
        'nama_kampus',
        'lokasi',
        'geom',
        'luas'
    ];

    public function getHashedIdAttribute()
    {
        return $this->hashids->encode($this->id);
    }

    public function kawasanHijau()
    {
        return $this->hasMany(KawasanHijau::class);
    }

    public function penggunaanLahan()
    {
        return $this->hasMany(PenggunaanLahan::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
