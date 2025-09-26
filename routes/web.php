<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KosController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/loginform', fn() => view('auth.login'))->name('loginform');

// Authentication Routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/penghuni/dashboard', function () {
    return view('penghuni.dashboard');
})->name('penghuni.dashboard');

Route::get('/admin/kos/{id}', [KosController::class, 'show'])->name('admin.kos.manage');
