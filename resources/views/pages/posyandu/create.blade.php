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
     style="width:60px; height:60px; background-color:#e3f2fd; color:#0d6efd;">
    <i class="fas fa-clinic-medical"></i>
</div>

                <h4 class="fw-bold mt-2 mb-1 text-primary">Tambah Posyandu</h4>
                <p class="text-muted mb-0">Isi form berikut untuk menambahkan posyandu baru</p>
            </div>

            <!-- Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('posyandu.store') }}" method="POST"
                  class="wow fadeInUp" data-wow-delay="0.3s"
                  novalidate enctype="multipart/form-data">
                @csrf

                <!-- Row 1 -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="fw-semibold">Nama Posyandu</label>
                        <input type="text"
                               name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama posyandu"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="fw-semibold">Alamat</label>
                        <input type="text"
                               name="alamat"
                               class="form-control @error('alamat') is-invalid @enderror"
                               value="{{ old('alamat') }}"
                               placeholder="Masukkan alamat posyandu"
                               required>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="row g-2 mb-2">
                    <div class="col-md-4">
                        <label class="fw-semibold">RT</label>
                        <input type="text"
                               name="rt"
                               class="form-control @error('rt') is-invalid @enderror"
                               value="{{ old('rt') }}"
                               placeholder="Masukkan RT"
                               required>
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="fw-semibold">RW</label>
                        <input type="text"
                               name="rw"
                               class="form-control @error('rw') is-invalid @enderror"
                               value="{{ old('rw') }}"
                               placeholder="Masukkan RW"
                               required>
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="fw-semibold">Kontak</label>
                        <input type="text"
                               name="kontak"
                               class="form-control @error('kontak') is-invalid @enderror"
                               value="{{ old('kontak') }}"
                               placeholder="Masukkan nomor kontak"
                               required>
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Upload -->
                <div class="mb-3">
                    <label class="fw-semibold d-block mb-1">
                        Upload Foto / Dokumen Posyandu
                    </label>
                    <input type="file"
                           name="fotos[]"
                           multiple
                           class="form-control @error('fotos') is-invalid @enderror">
                    <small class="text-muted">
                        Format: jpg, png, pdf | Maksimal 5MB
                    </small>
                    @error('fotos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-3 wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('posyandu.index') }}"
                       class="btn btn-primary rounded-pill px-3 py-1">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit"
                            class="btn btn-primary rounded-pill px-3 py-1">
                        <i class="fa fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
