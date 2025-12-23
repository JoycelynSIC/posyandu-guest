<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\CatatanImunisasiController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::view('/about', 'pages.about')->name('about');
Route::view('/kontak', 'pages.kontak')->name('kontak');

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
| AUTHENTICATED USER ROUTES (USER & ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

	// PROFILE
	Route::get('/profile', [UserController::class, 'profile'])->name('profile');
	Route::delete('/users/{id}/photo', [UserController::class, 'deletePhoto'])
		->name('users.photo.delete');
	Route::resource('users', UserController::class);

	// MEDIA
	Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');
	Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.delete');

	/*
	|--------------------------------------------------------------------------
	| JADWAL (SEMUA USER BISA LIHAT)
	|--------------------------------------------------------------------------
	*/
	Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (FULL AKSES)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

	// KADER
	Route::resource('kader', KaderController::class);

	// WARGA
	Route::delete('/warga/{id}/foto', [WargaController::class, 'deletePhoto'])
		->name('warga.photo.delete');
	Route::resource('warga', WargaController::class);

	// POSYANDU
	Route::resource('posyandu', PosyanduController::class);
	Route::get('/posyandu/{id}/delete-file/{index}', [PosyanduController::class, 'deleteFile'])
		->name('posyandu.deleteFile');

	/*
	|--------------------------------------------------------------------------
	| JADWAL (ADMIN CRUD)
	| ROUTE STATIS HARUS DI ATAS!
	|--------------------------------------------------------------------------
	*/
	Route::get('/jadwal/create', [JadwalController::class, 'create'])
		->name('jadwal.create');

	Route::post('/jadwal', [JadwalController::class, 'store'])
		->name('jadwal.store');

	Route::get('/jadwal/{jadwal}/edit', [JadwalController::class, 'edit'])
		->name('jadwal.edit');

	Route::put('/jadwal/{jadwal}', [JadwalController::class, 'update'])
		->name('jadwal.update');

	Route::delete('/jadwal/{jadwal}', [JadwalController::class, 'destroy'])
		->name('jadwal.destroy');

	/*
	|--------------------------------------------------------------------------
	| LAYANAN (ADMIN ONLY)
	|--------------------------------------------------------------------------
	*/
	Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
	Route::get('/layanan/create/{jadwal}', [LayananController::class, 'create'])
		->name('layanan.create');
	Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
	Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])
		->name('layanan.edit');
	Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
	Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])
		->name('layanan.destroy');
	Route::get('/layanan/jadwal/{jadwal}', [LayananController::class, 'jadwalLayanan'])
		->name('layanan.jadwal');

	/*
	|--------------------------------------------------------------------------
	| CATATAN IMUNISASI
	|--------------------------------------------------------------------------
	*/
	Route::resource('imunisasi', CatatanImunisasiController::class);
	Route::get('/imunisasi/{id}/delete-file', [CatatanImunisasiController::class, 'deleteFile'])
		->name('imunisasi.deleteFile');

	Route::get('/admin/users', [UserController::class, 'index'])
        ->name('users.admin.index');

    Route::put('/admin/users/{user}/role', [UserController::class, 'updateRole'])
        ->name('users.admin.updateRole');
});

/*
|--------------------------------------------------------------------------
| JADWAL DETAIL (PALING BAWAH, AGAR TIDAK TABRAK)
|--------------------------------------------------------------------------
*/
Route::get('/jadwal/{jadwal}', [JadwalController::class, 'show'])
	->whereNumber('jadwal')
	->name('jadwal.show');
