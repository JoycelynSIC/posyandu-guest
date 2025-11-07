@extends('layouts.guest.main')

@section('title', 'Register')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 position-relative overflow-hidden"
    style="background: linear-gradient(135deg, #016fda, #003d99);">

    {{-- 🌟 Background dekorasi lembut --}}
    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: radial-gradient(circle at top left, rgba(255,255,255,0.15), transparent 70%),
               radial-gradient(circle at bottom right, rgba(255,255,255,0.1), transparent 70%); 
               z-index: 0;">
    </div>

    {{-- 🌟 Card Registrasi --}}
    <div class="card shadow-lg border-0 p-4 wow fadeInUp position-relative"
        data-wow-delay="0.1s"
        style="width: 400px; border-radius: 25px; background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px); z-index: 1;">

        <!-- Header -->
        <div class="text-center mb-3 wow fadeInDown" data-wow-delay="0.15s">
            <a href="#" class="navbar-brand p-0">
                <h1 class="text-primary mb-0">
                    <i class="fab fa-slack me-2"></i> Registrasi
                </h1>
            </a>
            <p class="text-muted small mb-1">Buat akun baru untuk melanjutkan</p>
        </div>

        {{-- ⚠️ Pesan error --}}
        @if ($errors->any())
            <div class="alert alert-danger small py-2 text-center mb-2 wow fadeIn" data-wow-delay="0.2s">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- 🔹 Form Register --}}
        <form method="POST" action="{{ route('register.post') }}" class="wow fadeInUp" data-wow-delay="0.25s">
            @csrf
            <div class="mb-3">
                <label class="fw-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="form-control rounded-pill shadow-sm-sm"
                    value="{{ old('name') }}" placeholder="Masukkan nama kamu" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold mb-1">Email</label>
                <input type="email" name="email" class="form-control rounded-pill shadow-sm-sm"
                    value="{{ old('email') }}" placeholder="Masukkan email kamu" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold mb-1">Password</label>
                <input type="password" name="password" class="form-control rounded-pill shadow-sm-sm"
                    placeholder="Masukkan password" required>
            </div>

            <div class="mb-4">
                <label class="fw-semibold mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control rounded-pill shadow-sm-sm"
                    placeholder="Ulangi password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold wow fadeInUp"
                data-wow-delay="0.3s">
                Daftar
            </button>
        </form>

        <p class="mt-3 text-center mb-0 wow fadeInUp" data-wow-delay="0.4s">
            <small class="text-muted">Sudah punya akun?</small><br>
            <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">
                Login di sini
            </a>
        </p>
    </div>
</div>
@endsection
