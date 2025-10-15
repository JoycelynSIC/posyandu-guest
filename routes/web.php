<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jadwal_posyandu', [HomeController::class, 'index']);
Route::get('/auth', [AuthController::class, 'index'])->name('auth.form');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/welcome', function () {
    return view('auth.welcome', ['username' => session('username')]);
})->name('auth.welcome');
Route::get('/dashboard', [IndexController::class,'index']);