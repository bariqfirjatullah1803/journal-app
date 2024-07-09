<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::get('/', [AuthController::class, 'formLogin'])->name('index');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('journal', JournalController::class)->except(['show', 'create']);

    Route::middleware('role:coordinator')->group(function () {
        Route::resource('category', CategoryController::class)->except(['show']);
        Route::resource('user', UserController::class)->only(['index', 'create', 'store']);
    });
});

require __DIR__ . '/auth.php';
