@extends('layouts.guest.main')

@section('title', 'Tambah Posyandu')

@section('content')
<div class="py-4 bg-light d-flex justify-content-center">
    <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
         style="max-width:600px; width:100%; background-color:#f9fafb;">
        <div class="card-body p-3">

            <!-- Header -->
            <div class="text-center mb-3 wow fadeInDown" data-wow-delay="0.1s">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                     style="width:70px; height:70px; background-color:#e3f2fd; color:#0d6efd;">
                    <i class="fas fa-clinic-medical fa-lg"></i>
                </div>
                <h5 class="fw-bold mt-2 mb-1 text-primary">Tambah Posyandu</h5>
                <p class="text-muted mb-1" style="font-size:0.8rem;">Isi form berikut untuk menambahkan posyandu baru</p>
            </div>

            <!-- Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s" style="font-size:0.85rem;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('posyandu.store') }}" method="POST" class="wow fadeInUp" data-wow-delay="0.3s"
                  novalidate enctype="multipart/form-data">
                @csrf

                <!-- Nama & Alamat -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-clinic-medical me-1 text-primary"></i> Nama Posyandu</label>
                        <input type="text" name="nama" class="form-control form-control-sm @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="Nama Posyandu" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-map-marker-alt me-1 text-primary"></i> Alamat</label>
                        <input type="text" name="alamat" class="form-control form-control-sm @error('alamat') is-invalid @enderror"
                               value="{{ old('alamat') }}" placeholder="Alamat Posyandu" required>
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- RT & RW -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-home me-1 text-primary"></i> RT</label>
                        <input type="text" name="rt" class="form-control form-control-sm @error('rt') is-invalid @enderror"
                               value="{{ old('rt') }}" placeholder="RT" required>
                        @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-home me-1 text-primary"></i> RW</label>
                        <input type="text" name="rw" class="form-control form-control-sm @error('rw') is-invalid @enderror"
                               value="{{ old('rw') }}" placeholder="RW" required>
                        @error('rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Kontak & Upload Dokumen -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-phone me-1 text-primary"></i> Kontak</label>
                        <input type="text" name="kontak" class="form-control form-control-sm @error('kontak') is-invalid @enderror"
                               value="{{ old('kontak') }}" placeholder="Nomor Kontak" required>
                        @error('kontak')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-upload me-1 text-primary"></i> Upload Dokumen / Foto</label>
                        <input type="file" name="fotos[]" multiple class="form-control form-control-sm @error('fotos') is-invalid @enderror">
                        <small class="text-muted d-block">jpg, png | Max 5MB</small>
                        @error('fotos')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-3 wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('posyandu.index') }}" class="btn btn-outline-dark px-3 py-1">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-outline-primary px-3 py-1">
                        <i class="fa fa-save me-1"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
