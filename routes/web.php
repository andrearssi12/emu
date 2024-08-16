<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $data = [
        'pageTitle' => 'Beranda'
    ];
    return view('beranda', $data);
});
