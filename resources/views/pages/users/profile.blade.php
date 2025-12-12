@extends('layouts.guest.main')

@section('title', 'Profil Saya')

@section('content')
    <div class="py-5 bg-light">
        <div class="container">
            {{-- Header --}}
            <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.1s">
                <h1 class="text-primary fw-bold mb-1">Profil Saya</h1>
                <p class="text-muted mb-0">Informasi akun yang kamu gunakan saat ini</p>
            </div>

            {{-- Card Profil --}}
            <div class="d-flex justify-content-center">
                <div class="card border-0 rounded-4 shadow-sm p-4 wow fadeInUp" data-wow-delay="0.2s"
                    style="max-width: 480px; background-color: #ffffff;">

                    {{-- Foto Profil --}}
                    <div class="text-center mb-3">
                        <div class="position-relative d-inline-block">
                            {{-- Mengecek apakah ada gambar profil yang diupload --}}
                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('assets/img/placeholder.png') }}"
                                alt="{{ $user->name }}" class="rounded-circle shadow-sm border border-3 border-primary"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        </div>

                        <h4 class="fw-bold text-dark mt-3 mb-0">{{ $user->name }}</h4>
                        <p class="text-muted small mb-0">
                            <i class="fa fa-envelope text-primary me-1"></i>{{ $user->email }}
                        </p>
                    </div>

                    <hr class="my-3">

                    {{-- Detail Info --}}
                    <div class="px-3 small">
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted"><i class="fa fa-id-card me-2 text-primary"></i>Nama Lengkap</span>
                            <span class="fw-semibold text-dark">{{ $user->name }}</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted"><i class="fa fa-envelope me-2 text-primary"></i>Email</span>
                            <span class="fw-semibold text-dark">{{ $user->email }}</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted"><i class="fa fa-calendar-alt me-2 text-primary"></i>Tanggal Dibuat</span>
                            <span class="fw-semibold text-dark">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted"><i class="fa fa-sync-alt me-2 text-primary"></i>Terakhir Diperbarui</span>
                            <span class="fw-semibold text-dark">{{ $user->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    <hr class="my-3">

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-center align-items-center gap-3 mt-2 wow fadeInUp"
                        data-wow-delay="0.3s">
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                            <i class="fa fa-pen me-1"></i> Edit Profil
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus akun ini? Akunmu akan dihapus permanen.')"
                            class="m-0 p-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                                <i class="fa fa-trash me-1"></i> Hapus
                            </button>
                        </form>

                        <a href="{{ route('dashboard') }}"
                            class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                            <i class="fa fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

