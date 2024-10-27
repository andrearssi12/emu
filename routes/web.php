<?php

use App\Http\Middleware\UserAccess;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\GeoJson\GeoJsonController;
use App\Http\Controllers\Admin\Data\KampusController;
use App\Http\Controllers\Admin\Master\UserController;
use App\Http\Controllers\Admin\Data\KawasanHijauController;
use App\Http\Controllers\Admin\Data\PenggunaanLahanController;
use App\Models\KawasanHijau;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/kampus', [PetaController::class, 'petaKampus'])->name('peta.kampus');

Route::get('/peta', [PetaController::class, 'index'])->name('peta');

Route::get('/geojsondata', [GeoJsonController::class, 'getGeoJsonData'])->name('geojsonall');
Route::get('/geojsonkampus', [GeoJsonController::class, 'getGeoJsonKampusData'])->name('geojsonkampus');
Route::get('/geojsonpeta', [PetaController::class, 'getGeoJsonData'])->name('test');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::delete('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/save-drawn-features', [KampusController::class, 'saveDrawnFeatures']);
Route::get('/get-drawn-features', [KampusController::class, 'getDrawnFeatures']);


Route::middleware(['auth', UserAccess::class . ':2'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('master')->group(function () {
        Route::post('user/datatables', [UserController::class, 'dataTables'])->name('user.datatables');
        Route::get('user/{user}/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::resource('user', UserController::class)->parameters([
            'user' => 'user'
        ])->except('show');
    });

    Route::prefix('data')->group(function () {
        Route::post('kampus/datatables', [KampusController::class, 'dataTables'])->name('kampus.datatables');
        Route::get('kampus/{kampus}/delete', [KampusController::class, 'delete'])->name('kampus.delete');
        Route::resource('kampus', KampusController::class)->parameters([
            'kampus' => 'kampus'
        ]);
        Route::post('kawasan-hijau/datatables', [KawasanHijauController::class, 'dataTables'])->name('kawasan-hijau.datatables');
        Route::get('kawasan-hijau/{kawasanHijau}/delete', [KawasanHijau::class, 'delete'])->name('kawasan-hijau.delete');
        Route::resource('kawasan-hijau', KawasanHijauController::class)->parameters([
            'kawasan-hijau' => 'kawasanHijau'
        ]);
        Route::post('penggunaan/datatables', [PenggunaanLahanController::class, 'dataTables'])->name('penggunaan.datatables');
        Route::resource('penggunaan-lahan', PenggunaanLahanController::class)->parameters([
            'penggunaan-lahan' => 'penggunaanLahan'
        ]);
    });
});
