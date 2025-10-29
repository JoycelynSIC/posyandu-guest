@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="d-flex align-items-center justify-content-center"
    style="height: 100vh; background: linear-gradient(135deg, #016fda, #003d99); margin:0; padding:0;">

    <div class="card shadow-lg border-0 p-4" style="width: 400px; border-radius: 20px;">
        <div class="text-center mb-3">
            <a href="#" class="navbar-brand p-0">
                <h1 class="text-primary mb-0">
                    <i class="fab fa-slack me-2"></i> Registrasi
                </h1>
            </a>
            <p class="text-muted small">Buat akun baru untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger small py-2 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="mb-3">
                <label class="fw-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control rounded-pill"
                    value="{{ old('name') }}" placeholder="Masukkan nama kamu" required>
            </div>
            <div class="mb-3">
                <label class="fw-semibold">Email</label>
                <input type="email" name="email" class="form-control rounded-pill"
                    value="{{ old('email') }}" placeholder="Masukkan email kamu" required>
            </div>
            <div class="mb-3">
                <label class="fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded-pill"
                    placeholder="Masukkan password" required>
            </div>
            <div class="mb-3">
                <label class="fw-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control rounded-pill"
                    placeholder="Ulangi password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">Daftar</button>
        </form>

        <p class="mt-4 text-center mb-0">
            <small class="text-muted">Sudah punya akun?</small><br>
            <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">Login di sini</a>
        </p>
    </div>
</div>
@endsection
