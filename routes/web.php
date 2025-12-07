<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/jadwal_posyandu', [HomeController::class, 'index']);

// 🔹 AUTH ROUTES
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/profile', [UserController::class, 'showProfile'])->name('users.profile')->middleware('auth');

// 🔹 DASHBOARD ROUTE
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::resource('warga', WargaController::class);
    Route::resource('posyandu', PosyanduController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::resource('users', UserController::class);

});

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak');

use App\Http\Controllers\KaderController;

Route::resource('kader', KaderController::class);

Route::get('/cek-db', function () {
    return DB::connection()->getDatabaseName();
});

Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');
Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.delete');
Route::get('/posyandu/{id}', [PosyanduController::class, 'show'])->name('posyandu.show');
Route::get('/posyandu/{id}/delete-file/{index}', [PosyanduController::class, 'deleteFile'])
    ->name('posyandu.deleteFile');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/posyandu', [PosyanduController::class, 'index'])->name('posyandu.index');
    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/kader', [KaderController::class, 'index'])->name('kader.index');
    // route admin lain...
});