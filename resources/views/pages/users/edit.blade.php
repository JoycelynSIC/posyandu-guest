@extends('layouts.guest.main')

@section('title', 'Edit Profil')

@section('content')
    <div class="py-5 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width: 480px; width: 100%; padding: 1rem; box-sizing: border-box;">

            <!-- Header Profil -->
            <div class="text-center mb-3">
                <img id="fotoPreview" src="{{ $user->profile_image
        ? asset('storage/' . $user->profile_image)
        : asset('assets/img/placeholder.png') }}"
                    class="rounded-circle mb-2 shadow-sm border border-3 border-primary"
                    style="width:80px; height:80px; object-fit:cover;">
                <h5 class="fw-bold text-primary mb-1">Edit Profil</h5>
                <p class="text-muted small mb-0">Perbarui informasi akun kamu</p>
            </div>

            <!-- FORM UPDATE -->
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Alert --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s"
                        role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row g-2">
                    <!-- Upload Foto -->
                    <div class="col-12 col-sm-6">
                        <label class="form-label fw-semibold">Foto Profil</label>
                        <input type="file" name="profile_image" class="form-control form-control-sm" accept="image/*"
                            onchange="previewFoto(this)">
                        @error('profile_image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama -->
                    <div class="col-12 col-sm-6">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name"
                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-12 col-sm-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email"
                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-12 col-sm-6">
                        <label class="form-label fw-semibold">
                            Password Baru <span class="text-muted small">(opsional)</span>
                        </label>
                        <input type="password" name="password" class="form-control form-control-sm"
                            placeholder="Kosongkan jika tidak ingin mengubah">
                        @error('password')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="col-12 col-sm-6">
                        <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-sm"
                            placeholder="Ulangi password baru">
                    </div>
                </div>

                <!-- TOMBOL -->
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('profile') }}"
                        class="btn btn-outline-dark btn-sm flex-fill d-flex align-items-center justify-content-center"
                        style="min-height:36px;">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>

                    <button type="submit"
                        class="btn btn-outline-primary btn-sm flex-fill d-flex align-items-center justify-content-center"
                        style="min-height:36px;">
                        <i class="fa fa-save me-1"></i> Simpan
                    </button>

                    @if ($user->profile_image)
                        <button type="submit" form="delete-photo-form"
                            onclick="return confirm('Yakin ingin menghapus foto profil?')"
                            class="btn btn-outline-danger btn-sm flex-fill d-flex align-items-center justify-content-center"
                            style="min-height:36px;">
                            <i class="fa fa-trash me-1"></i> Hapus Foto
                        </button>
                    @endif
                </div>
            </form>

            <!-- FORM HAPUS FOTO -->
            @if ($user->profile_image)
                <form id="delete-photo-form" action="{{ route('users.photo.delete', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            @endif

        </div>
    </div>
@endsection