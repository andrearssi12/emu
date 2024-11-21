<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenggunaanLahan extends Model
{
    protected $hashids;
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->hashids = new Hashids(config('app.key'), 10); // Menggunakan key aplikasi dan panjang ID
    }

    protected $table = 'penggunaan_lahan';
    protected $fillable = [
        'id_kampus',
        'nama_lahan',
        'geom',
        'luas',
    ];

    public function getHashedIdAttribute()
    {
        return $this->hashids->encode($this->id);
    }

    public function kampus()
    {
        return $this->belongsTo(Kampus::class, 'id_kampus', 'id');
    }
}
