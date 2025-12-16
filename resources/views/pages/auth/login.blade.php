@extends('layouts.guest.main')

@section('title', 'Login')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 position-relative overflow-hidden"
    style="background: linear-gradient(135deg, #0154a7ff, #012357ff);">

    {{-- Background dekorasi --}}
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background:
        radial-gradient(circle at 10% 20%, rgba(255,255,255,0.18), transparent 60%),
        radial-gradient(circle at 90% 80%, rgba(255,255,255,0.12), transparent 60%);
        z-index: 0;">
    </div>

    {{-- CARD WRAPPER --}}
    <div class="card border-0 shadow-lg overflow-hidden wow fadeInUp position-relative"
        data-wow-delay="0.1s"
        style="width:880px; border-radius:28px; background: rgba(255,255,255,0.28); backdrop-filter: blur(10px); z-index:1;">

        <div class="row g-0">

            {{-- LEFT : LOGIN FORM (JANGAN DISENTUH) --}}
            <div class="col-md-6 bg-white p-4 p-md-5 wow fadeInLeft"
                style="border-top-left-radius:28px; border-bottom-left-radius:28px;">

                <div class="text-center mb-4 wow fadeInDown">
                    <h2 class="fw-bold text-primary mb-1">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </h2>
                    <p class="text-muted small">Silakan masuk untuk melanjutkan</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success py-2 text-center small wow fadeIn mb-3">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger py-2 text-center small wow fadeIn mb-3">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="wow fadeInUp">
                    @csrf

                    <div class="mb-3">
                        <label class="fw-semibold mb-1">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-envelope text-primary"></i>
                            </span>
                            <input type="email" name="email"
                                class="form-control border-0 bg-light @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="Masukkan email" required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback small d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold mb-1">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-lock text-primary"></i>
                            </span>
                            <input type="password" name="password"
                                class="form-control border-0 bg-light @error('password') is-invalid @enderror"
                                placeholder="Masukkan password" required>
                        </div>
                        @error('password')
                            <div class="invalid-feedback small d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="btn btn-primary w-100 rounded-pill py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 wow fadeInUp">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </button>
                </form>

                <p class="mt-4 text-center wow fadeInUp mb-0">
                    <small class="text-muted">Belum punya akun?</small><br>
                    <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-none">
                        Daftar di sini
                    </a>
                </p>
            </div>

            {{-- RIGHT : WELCOME (STYLE SAMA REGISTER + LOGO) --}}
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center p-5 wow fadeInRight"
                style="background:linear-gradient(160deg,#08072c,#0a58ca);color:#fff;">

                {{-- LOGO (SAMA REGISTER, SIZE TETAP) --}}
                <div class="mb-3"
                    style="background:rgba(0, 47, 255, 0.21);padding:14px 18px;border-radius:20px;">
                    <img src="{{ asset('assets/img/logoverti.png') }}"
                        alt="Logo Posyandu"
                        style="height:120px;object-fit:contain;">
                </div>

                <h2 class="fw-bold mb-3 text-white">Selamat Datang Kembali!</h2>

                <p class="small mb-4 text-white"
                    style="max-width:340px; line-height:1.6; opacity:.9;">
                    Masuk untuk mengelola data Posyandu dengan sistem yang lebih cepat, rapi, dan modern.
                </p>

                <div class="d-flex gap-2 mt-2">
                    <span class="rounded-circle" style="width:12px;height:12px;background:#fff;"></span>
                    <span class="rounded-circle" style="width:12px;height:12px;background:rgba(255,255,255,.6);"></span>
                    <span class="rounded-circle" style="width:12px;height:12px;background:rgba(255,255,255,.35);"></span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
