<?php

namespace App\Models;

use App\Models\Campus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maps extends Model
{
    use HasFactory;

    protected $table = 'maps_polygon';
    protected $fillable = ['campus_id', 'geom', 'area'];

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id', 'id');
    }
}
