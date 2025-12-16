@extends('layouts.guest.main')

@section('title', 'Register')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center position-relative wow fadeIn"
    style="background: linear-gradient(135deg, #0154a7ff, #012357ff); overflow:hidden;">

    {{-- Background dekorasi --}}
    <div class="position-absolute top-0 start-0 w-100 h-100 wow fadeIn"
        style="
        background:
        radial-gradient(circle at 10% 20%, rgba(255,255,255,0.18), transparent 60%),
        radial-gradient(circle at 90% 80%, rgba(255,255,255,0.12), transparent 60%);
        z-index:0;">
    </div>

    {{-- CARD --}}
    <div class="card border-0 shadow-lg overflow-hidden wow fadeInUp"
        data-wow-delay="0.1s"
        style="width:880px;border-radius:28px;background:rgba(255,255,255,.28);backdrop-filter:blur(10px);z-index:1;">

        <div class="row g-0">

            {{-- LEFT : WELCOME --}}
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center p-5 wow fadeInLeft"
                style="background:linear-gradient(-90deg,#08072c,#0a58ca);color:#fff;">

                <div class="mb-3 wow fadeInDown"
                  style="background:rgba(134, 182, 253, 0.46);padding:14px 18px;border-radius:20px;">
                    <img src="{{ asset('assets/img/logoverti.png') }}"
                        alt="Logo Posyandu"
                        style="height:120px;object-fit:contain;">
                </div>

                <h2 class="fw-bold mb-2 text-white wow fadeInUp">Selamat Datang</h2>

                <p class="small mb-3 opacity-90 wow fadeInUp"
                    style="max-width:320px;line-height:1.6;">
                    Daftar untuk menggunakan sistem Posyandu yang modern, praktis, dan mudah digunakan.
                </p>

                <div class="d-flex gap-2 wow fadeInUp">
                    <span class="rounded-circle" style="width:10px;height:10px;background:#fff;"></span>
                    <span class="rounded-circle" style="width:10px;height:10px;background:rgba(255,255,255,.6);"></span>
                    <span class="rounded-circle" style="width:10px;height:10px;background:rgba(255,255,255,.35);"></span>
                </div>
            </div>

            {{-- RIGHT : FORM --}}
            <div class="col-md-6 bg-white p-4 p-md-5 wow fadeInRight"
                style="border-top-right-radius:28px;border-bottom-right-radius:28px;">

                <div class="text-center mb-3 wow fadeInDown">
                    <h3 class="fw-bold text-primary mb-1">
                        <i class="fas fa-user-plus me-2"></i> Registrasi
                    </h3>
                    <p class="text-muted small mb-0">Buat akun baru untuk melanjutkan</p>
                </div>

                <form method="POST" action="{{ route('register.post') }}" class="wow fadeInUp">
                    @csrf

                    <div class="mb-2 wow fadeInUp">
                        <label class="fw-semibold small mb-1">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-user text-primary"></i>
                            </span>
                            <input type="text" name="name"
                                class="form-control bg-light border-0 rounded-end-pill py-2"
                                placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>

                    <div class="mb-2 wow fadeInUp">
                        <label class="fw-semibold small mb-1">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-envelope text-primary"></i>
                            </span>
                            <input type="email" name="email"
                                class="form-control bg-light border-0 rounded-end-pill py-2"
                                placeholder="Masukkan email" required>
                        </div>
                    </div>

                    <div class="mb-2 wow fadeInUp">
                        <label class="fw-semibold small mb-1">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-lock text-primary"></i>
                            </span>
                            <input type="password" name="password"
                                class="form-control bg-light border-0 rounded-end-pill py-2"
                                placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <div class="mb-3 wow fadeInUp">
                        <label class="fw-semibold small mb-1">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-key text-primary"></i>
                            </span>
                            <input type="password" name="password_confirmation"
                                class="form-control bg-light border-0 rounded-end-pill py-2"
                                placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <button type="submit"
                        class="btn btn-primary w-100 rounded-pill py-2 fw-semibold wow fadeInUp">
                        <i class="fas fa-user-plus me-1"></i> Daftar
                    </button>
                </form>

                <p class="mt-3 text-center mb-0 wow fadeInUp">
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
