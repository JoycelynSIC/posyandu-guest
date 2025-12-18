<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Halaman utama -> panggil DashboardController supaya $jadwal ada
Route::get('/', [DashboardController::class, 'index'])->name('home');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Tentang & kontak
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak');

// Cek database
Route::get('/cek-db', function () {
    return DB::connection()->getDatabaseName();
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // PROFILE
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::delete('/users/{id}/photo', [UserController::class, 'deletePhoto'])->name('users.photo.delete');

    // USERS
    Route::resource('users', UserController::class);

    // WARGA
    Route::delete('/warga/{id}/foto', [WargaController::class, 'deletePhoto'])->name('warga.photo.delete');
    Route::resource('warga', WargaController::class);

    // POSYANDU
    Route::resource('posyandu', PosyanduController::class);
    Route::get('/posyandu/{id}', [PosyanduController::class, 'show'])->name('posyandu.show');
    Route::get('/posyandu/{id}/delete-file/{index}', [PosyanduController::class, 'deleteFile'])
        ->name('posyandu.deleteFile');

    // MEDIA
    Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.delete');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/posyandu', [PosyanduController::class, 'index'])->name('posyandu.index');
    Route::get('/kader', [KaderController::class, 'index'])->name('kader.index');

    Route::resource('kader', KaderController::class);
});

/*
|--------------------------------------------------------------------------
| JADWAL ROUTES
|--------------------------------------------------------------------------
*/
Route::resource('jadwal', JadwalController::class);

/*
|--------------------------------------------------------------------------
| LAYANAN ROUTES
|-------------------------------------------------------------------------- 
*/

// USER & ADMIN → lihat layanan
Route::middleware(['auth'])->group(function () {

    // daftar layanan
    Route::get('/layanan', [LayananController::class, 'index'])
        ->name('layanan.index');

    // detail layanan
    Route::get('/layanan/{id}', [LayananController::class, 'show'])
        ->name('layanan.show');
});

// ADMIN ONLY → input & edit layanan
Route::middleware(['auth', 'admin'])->group(function () {

    // form tambah layanan (berdasarkan jadwal)
    Route::get('/layanan/create/{jadwal}', [LayananController::class, 'create'])
        ->name('layanan.create');

    // simpan layanan
    Route::post('/layanan', [LayananController::class, 'store'])
        ->name('layanan.store');

    // form edit layanan
    Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])
        ->name('layanan.edit');

    // update layanan
    Route::put('/layanan/{id}', [LayananController::class, 'update'])
        ->name('layanan.update');
});

Route::get('layanan/jadwal/{jadwal}', [LayananController::class, 'jadwalLayanan'])->name('layanan.jadwal');
Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');
Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');


