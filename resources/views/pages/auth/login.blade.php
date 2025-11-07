@extends('layouts.guest.main')

@section('title', 'Login')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 position-relative overflow-hidden"
    style="background: linear-gradient(135deg, #016fda, #003d99);">

    {{-- 🔹 Layer dekorasi background --}}
    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: radial-gradient(circle at top left, rgba(255,255,255,0.15), transparent 70%),
               radial-gradient(circle at bottom right, rgba(255,255,255,0.1), transparent 70%); 
               z-index: 0;">
    </div>

    {{-- 🔹 Card Login --}}
    <div class="card border-0 shadow-lg p-4 wow fadeInUp position-relative"
        data-wow-delay="0.1s"
        style="width: 400px; border-radius: 25px; background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px); z-index: 1;">

        <!-- Header -->
        <div class="text-center mb-3 wow fadeInDown" data-wow-delay="0.15s">
            <a href="#" class="navbar-brand p-0">
                <h1 class="text-primary mb-0">
                    <i class="fab fa-slack me-2"></i> Login
                </h1>
            </a>
            <p class="text-muted small mb-1">Silakan login untuk melanjutkan</p>
        </div>

        {{-- ✅ Pesan sukses --}}
        @if (session('status'))
            <div class="alert alert-success small py-2 text-center mb-2 wow fadeIn" data-wow-delay="0.2s">
                {{ session('status') }}
            </div>
        @endif

        {{-- ⚠️ Pesan error --}}
        @if (session('error'))
            <div class="alert alert-danger small py-2 text-center mb-2 wow fadeIn" data-wow-delay="0.2s">
                {{ session('error') }}
            </div>
        @endif

        {{-- 🔹 Form login --}}
        <form method="POST" action="{{ route('login.post') }}" class="wow fadeInUp" data-wow-delay="0.25s">
            @csrf
            <div class="mb-3">
                <label class="fw-semibold mb-1">Email</label>
                <input type="email" name="email"
                    class="form-control rounded-pill shadow-sm-sm @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="Masukkan email kamu" required>
                @error('email')
                    <div class="invalid-feedback small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="fw-semibold mb-1">Password</label>
                <input type="password" name="password"
                    class="form-control rounded-pill shadow-sm-sm @error('password') is-invalid @enderror"
                    placeholder="Masukkan password" required>
                @error('password')
                    <div class="invalid-feedback small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold mt-2 wow fadeInUp"
                data-wow-delay="0.3s">
                Masuk
            </button>
        </form>

        <p class="mt-3 text-center mb-0 wow fadeInUp" data-wow-delay="0.4s">
            <small class="text-muted">Belum punya akun?</small><br>
            <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-none">
                Daftar di sini
            </a>
        </p>
    </div>
</div>
@endsection
