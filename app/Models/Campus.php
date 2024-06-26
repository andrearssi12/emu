<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $table = 'campuses';
    protected $guarded = ['id'];

    public function maps()
    {
        return $this->hasMany(Maps::class, 'campus_id', 'id');
    }
}
