<?php

namespace App\Providers;

use App\Models\Kampus;
use App\Models\KawasanHijau;
use App\Models\PenggunaanLahan;
use App\Models\User;
use Hashids\Hashids;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $hashids;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set up your Hashids instance
        $this->hashids = new Hashids(config('app.key'), 10);

        // Custom route binding
        Route::bind('user', function ($value) {
            $originalId = $this->hashids->decode($value)[0] ?? null;
            return User::findOrFail($originalId);
        });
        // Custom route binding
        Route::bind('kampus', function ($value) {
            $originalId = $this->hashids->decode($value)[0] ?? null;
            return Kampus::findOrFail($originalId);
        });
        // Custom route binding
        Route::bind('kawasanHijau', function ($value) {
            $originalId = $this->hashids->decode($value)[0] ?? null;
            return KawasanHijau::findOrFail($originalId);
        });
        // Custom route binding
        Route::bind('penggunaanLahan', function ($value) {
            $originalId = $this->hashids->decode($value)[0] ?? null;
            return PenggunaanLahan::findOrFail($originalId);
        });
    }
}
