<?php

use App\Http\Controllers\Admin\CampusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\Admin\MapsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\UserAccess;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/peta', [PetaController::class, 'index'])->name('peta');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::delete('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/admin/maps/view', [MapsController::class, 'mapsView'])->middleware([UserAccess::class . ':2'])->name('maps.view');
    Route::post('/admin/maps/dataTables', [MapsController::class, 'dataTables'])->middleware([UserAccess::class . ':2'])->name('maps.datatables');
    Route::resource('/admin/maps', MapsController::class)->middleware([UserAccess::class . ':2']);
    Route::post('/admin/campus/dataTables', [CampusController::class, 'dataTables'])->middleware([UserAccess::class . ':2'])->name('campus.datatables');
    Route::resource('/admin/campus', CampusController::class)->middleware([UserAccess::class . ':2']);
});
