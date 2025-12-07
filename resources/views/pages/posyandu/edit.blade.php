@extends('layouts.guest.main')

@section('title', 'Edit Posyandu')

@section('content')
    <div class="py-5 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4" style="max-width: 600px; width: 100%; background-color: #f9fafb;">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                        style="width: 100px; height: 100px; background-color: #e3f2fd; color: #0d6efd;">
                        <i class="fas fa-clinic-medical fa-3x"></i>
                    </div>
                    <h4 class="fw-bold mt-3 mb-1 text-primary">Edit Data Posyandu</h4>
                    <p class="text-muted mb-0">Perbarui informasi posyandu kamu di sini</p>
                </div>

                <!-- Notifikasi sukses -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Notifikasi error -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Error validation -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Form Edit -->
                <form action="{{ route('posyandu.update', $posyandu->posyandu_id) }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="fw-semibold">Nama Posyandu</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $posyandu->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Alamat</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            value="{{ old('alamat', $posyandu->alamat) }}" required>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">RT</label>
                            <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror"
                                value="{{ old('rt', $posyandu->rt) }}" required>
                            @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">RW</label>
                            <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror"
                                value="{{ old('rw', $posyandu->rw) }}" required>
                            @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold">Kontak</label>
                        <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror"
                            value="{{ old('kontak', $posyandu->kontak) }}" required>
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload file baru -->
                    <div class="mb-4">
                        <label class="fw-semibold d-block mb-1">Upload Foto Posyandu (bisa banyak)</label>
                        <input type="file" name="fotos[]" multiple
                            class="form-control @error('fotos') is-invalid @enderror">
                        <small class="text-muted">Format: jpg, png, pdf | Max 5MB</small>
                        @error('fotos')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tampilkan file yang sudah ada -->
                    @if (!empty($fotos) && $fotos->count() > 0)
                        <div class="mt-3">
                            <label class="fw-semibold">File yang sudah ada:</label>
                            <div class="row g-3 mt-2">
                                @foreach ($fotos as $index => $foto)
                                    <div class="col-6 text-center">
                                        @if (Str::endsWith($foto->file_url, ['.jpg', '.jpeg', '.png']))
                                            <img src="{{ asset('storage/' . $foto->file_url) }}" class="img-fluid rounded mb-2"
                                                style="height:120px; object-fit:cover;">
                                        @else
                                            <i class="fa fa-file-pdf fa-3x text-danger mb-2"></i>
                                        @endif
                                        <p class="small text-truncate">{{ basename($foto->file_url) }}</p>

                                        <!-- Tombol lihat file -->
                                        <div class="d-flex flex-column gap-2">
                                            <!-- Tombol Lihat File -->
                                            <a href="{{ asset('storage/' . $foto->file_url) }}" target="_blank"
                                                class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center gap-2 shadow-sm">
                                                <i class="fa fa-eye"></i> Lihat File
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <a href="{{ route('posyandu.deleteFile', ['id' => $posyandu->posyandu_id, 'index' => $index]) }}"
                                                class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                                onclick="return confirm('Hapus file ini?')">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('posyandu.index') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa fa-save me-1"></i> Perbarui
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection