@extends('layouts.main')

@section('title', 'Edit Profil')

@section('content')
<div class="container py-5 d-flex justify-content-center">
    <div class="card shadow-sm border-0 rounded-4" style="max-width: 500px; width: 100%;">
        <div class="card-body p-4">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm"
                    style="width: 100px; height: 100px; background-color: #fce4ec; font-size: 36px; font-weight: 600; color: #333;">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <h4 class="fw-bold mt-3">Edit Profil</h4>
                <p class="text-muted mb-0">Perbarui informasi akun kamu di sini</p>
            </div>

            <!-- Form -->
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password Baru <span class="text-muted small">(opsional)</span></label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('profile') }}" class="btn btn-primary px-4">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
