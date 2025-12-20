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
    use App\Http\Controllers\CatatanImunisasiController;

    /*
    |--------------------------------------------------------------------------
    | PUBLIC ROUTES
    |--------------------------------------------------------------------------
    */

    // Halaman utama
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tentang & kontak (statis)
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/kontak', 'pages.kontak')->name('kontak');

    // Cek database (debug)
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
        Route::get('/posyandu/{id}/delete-file/{index}', [PosyanduController::class, 'deleteFile'])
            ->name('posyandu.deleteFile');

        // MEDIA
        Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');
        Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.delete');

        // LAYANAN (USER & ADMIN melihat layanan)
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
        Route::get('layanan/jadwal/{jadwal}', [LayananController::class, 'jadwalLayanan'])->name('layanan.jadwal');

       Route::resource('imunisasi', CatatanImunisasiController::class);

// Hapus file khusus, mirip Posyandu
Route::get('/imunisasi/{id}/delete-file', [CatatanImunisasiController::class, 'deleteFile'])
    ->name('imunisasi.deleteFile');



    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'admin'])->group(function () {

        // Admin dashboard & data master
        Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/posyandu', [PosyanduController::class, 'index'])->name('posyandu.index');
        Route::get('/kader', [KaderController::class, 'index'])->name('kader.index');

        // KADER CRUD
        Route::resource('kader', KaderController::class);

        // LAYANAN (ADMIN input & edit)
        Route::get('/layanan/create/{jadwal}', [LayananController::class, 'create'])->name('layanan.create');
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
        Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
        Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | JADWAL ROUTES
    |--------------------------------------------------------------------------
    */
    Route::resource('jadwal', JadwalController::class);

