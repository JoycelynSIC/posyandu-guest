@extends('layouts.guest.main')

@section('title', 'Edit Profil')

@section('content')
<div class="py-5 bg-light d-flex justify-content-center">
    <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
         style="max-width: 500px; width: 100%; background-color: #f9fafb;">
        <div class="card-body p-4">

            <!-- Header Profil Picture -->
            <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.1s">
                @if ($user->profile_image)
                    <!-- Menampilkan Gambar yang Di-upload -->
                    <img src="{{ asset('storage/' . $user->profile_image) }}"
                         class="rounded-circle mb-2 shadow-sm border border-3 border-primary"
                         style="width:100px; height:100px; object-fit:cover;">
                @else
                    <!-- Menampilkan Placeholder jika Tidak Ada Gambar yang Di-upload -->
                    <img src="{{ asset('assets/img/placeholder.png') }}"
                         class="rounded-circle mb-2 shadow-sm border border-3 border-primary"
                         style="width:100px; height:100px; object-fit:cover;">
                @endif
                <h4 class="fw-bold mt-2 mb-1 text-primary">Edit Profil</h4>
                <p class="text-muted mb-0">Perbarui informasi akun kamu di sini</p>
            </div>

            <!-- Form Edit -->
            <form action="{{ route('users.update', $user->id) }}" method="POST"
                  enctype="multipart/form-data" class="wow fadeInUp" data-wow-delay="0.2s">
                @csrf
                @method('PUT')

                <!-- Upload Foto Profil -->
                <div class="mb-3">
                    <label for="profile_image" class="form-label fw-semibold">Upload Foto Profil</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control"
                           accept="image/*">
                    @error('profile_image')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Lengkap -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Baru -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        Password Baru <span class="text-muted small">(opsional)</span>
                    </label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Kosongkan jika tidak ingin mengubah password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control" placeholder="Ulangi password baru">
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4 wow fadeInUp" data-wow-delay="0.3s">
                    <a href="{{ route('profile') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fa fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
