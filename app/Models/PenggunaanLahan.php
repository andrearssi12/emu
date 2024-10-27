<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanLahan extends Model
{
    use HasFactory;

    protected $table = 'penggunaan_lahan';
    protected $fillable = [
        'id_kampus',
        'nama_lahan',
        'geom',
        'luas',
    ];

    public function kampus()
    {
        return $this->belongsTo(Kampus::class, 'id_kampus', 'id');
    }
}
