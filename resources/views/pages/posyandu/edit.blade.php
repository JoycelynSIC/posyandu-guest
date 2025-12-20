@extends('layouts.guest.main')

@section('title', 'Edit Posyandu')

@section('content')
<div class="py-3 bg-light d-flex justify-content-center">
    <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
         style="max-width:600px; width:100%; background-color:#f9fafb;">
        <div class="card-body p-3">

            <!-- Header -->
            <div class="text-center mb-2 wow fadeInDown" data-wow-delay="0.1s">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                     style="width:70px; height:70px; background-color:#e3f2fd; color:#0d6efd;">
                    <i class="fas fa-clinic-medical fa-lg"></i>
                </div>

                <h5 class="fw-bold mt-2 mb-1 text-primary">Edit Posyandu</h5>
                <p class="text-muted mb-1" style="font-size:0.8rem;">Perbarui informasi posyandu</p>
            </div>

            <!-- Error Validation -->
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
            <form action="{{ route('posyandu.update', $posyandu->posyandu_id) }}" method="POST" enctype="multipart/form-data" class="wow fadeInUp" data-wow-delay="0.3s" novalidate>
                @csrf
                @method('PUT')

                <!-- Nama & Alamat -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-clinic-medical me-1 text-primary"></i> Nama Posyandu</label>
                        <input type="text" name="nama" class="form-control form-control-sm @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $posyandu->nama) }}" placeholder="Nama Posyandu" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-map-marker-alt me-1 text-primary"></i> Alamat</label>
                        <input type="text" name="alamat" class="form-control form-control-sm @error('alamat') is-invalid @enderror"
                               value="{{ old('alamat', $posyandu->alamat) }}" placeholder="Alamat Posyandu" required>
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- RT & RW -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-home me-1 text-primary"></i> RT</label>
                        <input type="text" name="rt" class="form-control form-control-sm @error('rt') is-invalid @enderror"
                               value="{{ old('rt', $posyandu->rt) }}" placeholder="RT" required>
                        @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-home me-1 text-primary"></i> RW</label>
                        <input type="text" name="rw" class="form-control form-control-sm @error('rw') is-invalid @enderror"
                               value="{{ old('rw', $posyandu->rw) }}" placeholder="RW" required>
                        @error('rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Kontak & Upload Dokumen -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-phone me-1 text-primary"></i> Kontak</label>
                        <input type="text" name="kontak" class="form-control form-control-sm @error('kontak') is-invalid @enderror"
                               value="{{ old('kontak', $posyandu->kontak) }}" placeholder="Nomor Kontak" required>
                        @error('kontak')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="fw-semibold"><i class="fa fa-upload me-1 text-primary"></i> Upload Dokumen</label>
                        <input type="file" name="fotos[]" multiple class="form-control form-control-sm @error('fotos') is-invalid @enderror">
                        <small class="text-muted d-block">jpg, png, pdf | Max 5MB</small>
                        @error('fotos')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- File Lama Horizontal Scroll -->
                @if (!empty($fotos) && $fotos->count() > 0)
                    <div class="mb-2">
                        <label class="fw-semibold"><i class="fa fa-folder-open me-1 text-primary"></i> File yang sudah ada:</label>
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
