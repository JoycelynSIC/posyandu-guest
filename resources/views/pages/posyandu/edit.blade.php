@extends('layouts.guest.main')

@section('title', 'Edit Posyandu')

@section('content')
    <div class="py-4 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width:650px; width:100%; background-color:#f9fafb;">
            <div class="card-body p-3">

                <!-- Header -->
                <div class="text-center mb-3 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                        style="width:90px; height:90px; background-color:#e3f2fd; color:#0d6efd;">
                        <i class="fas fa-clinic-medical fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mt-2 mb-1 text-primary">Edit Data Posyandu</h4>
                    <p class="text-muted mb-0">Perbarui informasi posyandu kamu</p>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
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
                <form action="{{ route('posyandu.update', $posyandu->posyandu_id) }}" method="POST"
                    enctype="multipart/form-data" novalidate class="wow fadeInUp" data-wow-delay="0.3s">
                    @csrf
                    @method('PUT')

                    <!-- Row 1: Nama + Alamat -->
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="fw-semibold">Nama Posyandu</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $posyandu->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat', $posyandu->alamat) }}" required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 2: RT + RW -->
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="fw-semibold">RT</label>
                            <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror"
                                value="{{ old('rt', $posyandu->rt) }}" required>
                            @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold">RW</label>
                            <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror"
                                value="{{ old('rw', $posyandu->rw) }}" required>
                            @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 3: Kontak + Upload Foto -->
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="fw-semibold">Kontak</label>
                            <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror"
                                value="{{ old('kontak', $posyandu->kontak) }}" required>
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold d-block mb-1">Upload Foto</label>
                            <input type="file" name="fotos[]" multiple
                                class="form-control @error('fotos') is-invalid @enderror">
                            <small class="text-muted">jpg, png, pdf | Max 5MB</small>
                            @error('fotos')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- File Lama Horizontal Scroll -->
                    @if (!empty($fotos) && $fotos->count() > 0)
                        <div class="mb-2">
                            <label class="fw-semibold">File yang sudah ada:</label>
                            <div class="d-flex overflow-auto gap-2 py-1">
                                @foreach ($fotos as $index => $foto)
                                    <div class="text-center flex-shrink-0" style="width:100px;">
                                        @if (Str::endsWith($foto->file_name, ['.jpg', '.jpeg', '.png']))
                                            <img src="{{ asset('storage/' . $foto->file_name) }}" class="img-fluid rounded mb-1"
                                                style="height:80px; object-fit:cover;">
                                        @else
                                            <i class="fa fa-file-pdf fa-2x text-danger mb-1"></i>
                                        @endif
                                        <p class="small text-truncate">{{ basename($foto->file_name) }}</p>
                                        <button type="button"
                                            class="btn btn-outline-primary btn-sm w-100 py-1 mb-1 d-flex align-items-center justify-content-center gap-2"
                                            data-bs-toggle="modal" data-bs-target="#previewModal{{ $index }}">
                                            <i class="fa fa-eye"></i> Lihat
                                        </button>
                                        <div class="modal fade" id="previewModal{{ $index }}" tabindex="-1"
                                            aria-labelledby="previewModalLabel{{ $index }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="previewModalLabel{{ $index }}">
                                                            {{ basename($foto->file_name) }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        @if (\Illuminate\Support\Str::endsWith($foto->file_name, ['.jpg', '.jpeg', '.png']))
                                                            <img src="{{ asset('storage/' . $foto->file_name) }}" class="img-fluid"
                                                                style="max-height:80vh; object-fit:contain;">
                                                        @else
                                                            <iframe src="{{ asset('storage/' . $foto->file_name) }}" class="w-100"
                                                                style="height:80vh;"></iframe>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('posyandu.deleteFile', ['id' => $posyandu->posyandu_id, 'index' => $index]) }}"
                                            class="btn btn-outline-danger btn-sm w-100 py-1 d-flex align-items-center justify-content-center gap-2"
                                            onclick="return confirm('Hapus file ini?')">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-3 wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('posyandu.index') }}" class="btn btn-outline-dark px-3 py-1">
                            <i class="fa fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-outline-primary px-3 py-1">
                            <i class="fa fa-save me-1"></i> Perbarui
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection