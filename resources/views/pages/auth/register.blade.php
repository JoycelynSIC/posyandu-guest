@extends('layouts.guest.main')

@section('title', 'Register')

@section('content')

    <div class="min-vh-100 d-flex align-items-center justify-content-center"
        style="background: linear-gradient(135deg, #016fda, #003d99); position: relative; overflow: hidden;">

        {{-- Background Dekorasi --}}
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background:
            radial-gradient(circle at 10% 20%, rgba(255,255,255,0.18), transparent 60%),
            radial-gradient(circle at 90% 80%, rgba(255,255,255,0.12), transparent 60%);
        z-index: 0;">
        </div>

        {{-- WRAPPER CARD --}}
        <div class="card border-0 shadow-lg overflow-hidden wow fadeInUp" data-wow-delay="0.1s"
            style="width: 860px; border-radius: 28px; z-index: 1; background: rgba(255,255,255,0.25); backdrop-filter: blur(10px);">

            <div class="row g-0">

                {{-- ================= LEFT SIDE ================= --}}
                <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center p-5"
                    style="background: rgba(255,255,255,0.20); backdrop-filter: blur(8px);">

                    <h2 class="mb-4 wow fadeInUp fw-bold text-primar" data-wow-delay="0.2s">
                        Selamat Datang!
                    </h2>

                    <p class="text-muted small text-center mt-2 px-4 wow fadeInUp mb-4 wow fadeInUp fw-bold text-primar"
                        style="line-height: 1.5; color: #000000;">
                        Posyandu kini lebih modern – pencatatan ibu, bayi dan balita menjadi lebih mudah, cepat, dan
                        efisien.
                    </p>


                    {{-- Dekorasi Bulatan Estetik --}}
                    <div class="mt-4 d-flex gap-2 wow fadeInUp" data-wow-delay="0.25s">
                        <div style="width: 14px; height: 14px; border-radius:50%; background: rgba(255,255,255,0.9);"></div>
                        <div style="width: 14px; height: 14px; border-radius:50%; background: rgba(255,255,255,0.6);"></div>
                        <div style="width: 14px; height: 14px; border-radius:50%; background: rgba(255,255,255,0.35);">
                        </div>
                    </div>

                </div>

                {{-- ================= RIGHT SIDE FORM ================= --}}
                <div class="col-md-6 bg-white p-4" style="border-top-right-radius: 28px; border-bottom-right-radius: 28px;">

                    <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.15s">
                        <h2 class="fw-bold text-primary mb-1">
                            <i class="fas fa-user-plus me-2"></i> Registrasi
                        </h2>
                        <p class="text-muted small">Buat akun baru untuk melanjutkan</p>
                    </div>

                    {{-- Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger small py-2 text-center wow fadeIn" data-wow-delay="0.2s">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form method="POST" action="{{ route('register.post') }}" class="wow fadeInUp" data-wow-delay="0.25s">
                        @csrf

                        <div class="mb-3">
                            <label class="fw-semibold mb-1">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-user text-primary"></i>
                                </span>
                                <input type="text" name="name" class="form-control border-0 shadow-none"
                                    placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold mb-1">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                                <input type="email" name="email" class="form-control border-0 shadow-none"
                                    placeholder="Masukkan email kamu" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold mb-1">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input type="password" name="password" class="form-control border-0 shadow-none"
                                    placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="fw-semibold mb-1">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-key text-primary"></i>
                                </span>
                                <input type="password" name="password_confirmation"
                                    class="form-control border-0 shadow-none" placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold wow fadeInUp"
                            data-wow-delay="0.3s">
                            <i class="fas fa-user-plus me-1"></i> Daftar
                        </button>
                    </form>

                    <p class="mt-4 text-center wow fadeInUp" data-wow-delay="0.35s">
                        <small class="text-muted">Sudah punya akun?</small><br>
                        <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">
                            Login di sini
                        </a>
                    </p>

                </div>

            </div>
        </div>
    </div>

@endsection
