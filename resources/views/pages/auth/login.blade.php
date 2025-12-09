@extends('layouts.guest.main')

@section('title', 'Login')

@section('content')
    <div class="d-flex align-items-center justify-content-center min-vh-100 position-relative overflow-hidden"
        style="background: linear-gradient(135deg, #016fda, #003d99);">

        {{-- 🔹 Dekorasi background --}}
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background:
                radial-gradient(circle at 10% 20%, rgba(255,255,255,0.18), transparent 60%),
                radial-gradient(circle at 90% 80%, rgba(255,255,255,0.12), transparent 60%);
                z-index: 0;">
        </div>

        {{-- 🔹 Card Login --}}
        <div class="card border-0 shadow-lg p-4 wow fadeInUp position-relative" data-wow-delay="0.1s" style="
                width: 420px;
                border-radius: 28px;
                background: rgba(255,255,255,0.95);
                backdrop-filter: blur(10px);
                z-index: 1;
            ">

            {{-- Header --}}
            <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.15s">
                <h1 class="text-primary mb-2" style="font-weight: 800;">
                    <i class="fab fa-slack me-2" style="font-size: 42px;"></i>
                    <span style="font-size: 30px;">Login</span>
                </h1>
                <p class="text-muted small">Silakan masuk untuk melanjutkan</p>
            </div>

            {{-- 🔹 Sukses --}}
            @if (session('status'))
                <div class="alert alert-success py-2 text-center small wow fadeIn mb-3" data-wow-delay="0.2s">
                    {{ session('status') }}
                </div>
            @endif

            {{-- 🔹 Error --}}
            @if (session('error'))
                <div class="alert alert-danger py-2 text-center small wow fadeIn mb-3" data-wow-delay="0.2s">
                    {{ session('error') }}
                </div>
            @endif

            {{-- 🔹 FORM LOGIN --}}
            <form method="POST" action="{{ route('login.post') }}" class="wow fadeInUp" data-wow-delay="0.25s">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label class="fw-semibold mb-1">Email</label>
                    <div class="input-group" style="border: none !important;">
                        <span class="input-group-text bg-white border-0 px-3">
                            <i class="fas fa-envelope text-primary"></i>
                        </span>
                        <input type="email" name="email"
                            class="form-control border-0 shadow-none @error('email') is-invalid @enderror"
                            style="background: white !important;" value="{{ old('email') }}"
                            placeholder="Masukkan email kamu" required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback small d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="fw-semibold mb-1">Password</label>
                    <div class="input-group" style="border: none !important;">
                        <span class="input-group-text bg-white border-0 px-3">
                            <i class="fas fa-lock text-primary"></i>
                        </span>
                        <input type="password" name="password"
                            class="form-control border-0 shadow-none @error('password') is-invalid @enderror"
                            style="background: white !important;" placeholder="Masukkan password" required>
                    </div>
                    @error('password')
                        <div class="invalid-feedback small d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="btn btn-primary w-100 rounded-pill py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 wow fadeInUp"
                    data-wow-delay="0.3s" style="letter-spacing: .5px;">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </button>

            </form>

            {{-- Daftar --}}
            <p class="mt-4 text-center wow fadeInUp mb-0" data-wow-delay="0.35s">
                <small class="text-muted">Belum punya akun?</small><br>
                <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-none">
                    Daftar di sini
                </a>
            </p>

        </div>
    </div>
@endsection