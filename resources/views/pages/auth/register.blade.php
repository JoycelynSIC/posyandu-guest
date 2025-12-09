@extends('layouts.guest.main')

@section('title', 'Register')

@section('content')
    <div class="d-flex align-items-center justify-content-center min-vh-100 position-relative overflow-hidden"
        style="background: linear-gradient(135deg, #016fda, #003d99);">

        {{-- 🌟 Background dekorasi --}}
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background:
                radial-gradient(circle at 10% 20%, rgba(255,255,255,0.18), transparent 60%),
                radial-gradient(circle at 90% 80%, rgba(255,255,255,0.12), transparent 60%);
                z-index: 0;">
        </div>

        {{-- 🌟 Card Register --}}
        <div class="card shadow-lg border-0 p-4 wow fadeInUp position-relative" data-wow-delay="0.1s" style="
                width: 420px;
                border-radius: 28px;
                background: rgba(255,255,255,0.95);
                backdrop-filter: blur(10px);
                z-index: 1;
            ">

            <!-- Header -->
            <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.15s">
                <h1 class="text-primary mb-1" style="font-weight: 800;">
                    <i class="fab fa-slack me-2" style="font-size: 40px;"></i>
                    <span style="font-size: 32px;">Registrasi</span>
                </h1>
                <p class="text-muted small">Buat akun baru untuk melanjutkan</p>
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div class="alert alert-danger small py-2 text-center mb-2 wow fadeIn" data-wow-delay="0.2s">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- FORM REGISTER --}}
            <form method="POST" action="{{ route('register.post') }}" class="wow fadeInUp" data-wow-delay="0.25s">
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="fw-semibold mb-1">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0">
                            <i class="fas fa-user text-primary"></i>
                        </span>
                        <input type="text" name="name" class="form-control border-0 shadow-none" value="{{ old('name') }}"
                            placeholder="Masukkan nama lengkap" required>
                    </div>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="fw-semibold mb-1">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0">
                            <i class="fas fa-envelope text-primary"></i>
                        </span>
                        <input type="email" name="email" class="form-control border-0 shadow-none"
                            value="{{ old('email') }}" placeholder="Masukkan email kamu" required>
                    </div>
                </div>

                {{-- Password --}}
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

                {{-- Konfirmasi --}}
                <div class="mb-4">
                    <label class="fw-semibold mb-1">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0">
                            <i class="fas fa-key text-primary"></i>
                        </span>
                        <input type="password" name="password_confirmation" class="form-control border-0 shadow-none"
                            placeholder="Ulangi password" required>
                    </div>
                </div>

                {{-- Tombol --}}
                <button type="submit"
                    class="btn btn-primary w-100 rounded-pill py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 wow fadeInUp"
                    data-wow-delay="0.3s">
                    <i class="fas fa-user-plus"></i>
                    Daftar
                </button>

            </form>

            {{-- Login --}}
            <p class="mt-4 text-center wow fadeInUp" data-wow-delay="0.35s">
                <small class="text-muted">Sudah punya akun?</small><br>
                <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">
                    Login di sini
                </a>
            </p>

        </div>
    </div>
@endsection