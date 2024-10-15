<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Hashids\Hashids;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $hashids;
    use HasFactory, Notifiable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->hashids = new Hashids(config('app.key'), 10); // Menggunakan key aplikasi dan panjang ID
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getHashedIdAttribute()
    {
        return $this->hashids->encode($this->id);
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
            set: fn(string $value) => strtolower($value),
        );
    }

    protected function nama(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
            set: fn(string $value) => strtolower($value),
        );
    }

    protected function role(): Attribute
    {
        return Attribute::make(
            get: fn(int $value) => match ($value) {
                1 => 'User',
                2 => 'Admin'
            },

            set: fn(string $value) => match (strtolower($value)) {
                'user' => 1,
                'admin' => 2
            }
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn(int $value) => match ($value) {
                1 => 'Aktif',
                0 => 'Nonaktif'
            },

            set: fn(string $value) => match (strtolower($value)) {
                'aktif' => 1,
                'nonaktif' => 0
            }
        );
    }
}
