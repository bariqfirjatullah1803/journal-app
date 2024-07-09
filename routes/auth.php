<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
    Route::get('/login', 'formLogin')->name('login');
    Route::post('/login', 'login')->name('login.submit');
});
