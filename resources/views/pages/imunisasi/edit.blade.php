@extends('layouts.guest.main')

@section('title', 'Edit Catatan Imunisasi')

@section('content')
    <div class="py-3 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width:600px; width:100%; background-color:#f9fafb;">
            <div class="card-body p-3">

                <!-- Header -->
                <div class="text-center mb-2 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                        style="width:70px; height:70px; background-color:#e3f2fd; color:#0d6efd;">
                        <i class="fas fa-syringe fa-lg"></i>
                    </div>
                    <h5 class="fw-bold mt-2 mb-1 text-primary">Edit Catatan Imunisasi</h5>
                    <p class="text-muted mb-1" style="font-size:0.8rem;">Perbarui data imunisasi warga</p>
                </div>

                <!-- Error Validation -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s"
                        style="font-size:0.85rem;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('imunisasi.update', $data) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <!-- Warga & Jenis Vaksin -->
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="fw-semibold">
                                <i class="fa fa-user me-1 text-primary"></i> Warga
                            </label>
                            <select name="warga_id"
                                class="form-select form-select-sm @error('warga_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}" {{ old('warga_id', $data->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('warga_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-semibold">
                                <i class="fa fa-virus me-1 text-primary"></i> Jenis Vaksin
                            </label>
                            <input type="text" name="jenis_vaksin"
                                class="form-control form-control-sm @error('jenis_vaksin') is-invalid @enderror"
                                value="{{ old('jenis_vaksin', $data->jenis_vaksin) }}" placeholder="MR, Polio" required>
                            @error('jenis_vaksin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Tanggal & Lokasi -->
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="fw-semibold">
                                <i class="fa fa-calendar-days me-1 text-primary"></i> Tanggal
                            </label>
                            <input type="date" name="tanggal"
                                class="form-control form-control-sm @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d')) }}"
                                required>
                            @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-semibold">
                                <i class="fa fa-map-marker-alt me-1 text-primary"></i> Lokasi
                            </label>
                            <input type="text" name="lokasi"
                                class="form-control form-control-sm @error('lokasi') is-invalid @enderror"
                                value="{{ old('lokasi', $data->lokasi) }}" placeholder="Posyandu Melati">
                            @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Nakes & Upload -->
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="fw-semibold">
                                <i class="fa fa-user-md me-1 text-primary"></i> Petugas Nakes
                            </label>
                            <input type="text" name="nakes"
                                class="form-control form-control-sm @error('nakes') is-invalid @enderror"
                                value="{{ old('nakes', $data->nakes) }}" placeholder="Nama petugas">
                            @error('nakes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-semibold">
                                <i class="fa fa-upload me-1 text-primary"></i> Upload Dokumen
                            </label>
                            <input type="file" name="file_name"
                                class="form-control form-control-sm @error('file_name') is-invalid @enderror">
                            <small class="text-muted d-block">jpg, png, pdf</small>
                            @error('file_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- File Lama -->
                    <!-- File Lama -->

                    @if ($data->file_name)
                        <div class="mb-3">
                            <label class="fw-semibold">
                                <i class="fa fa-folder-open me-1 text-primary"></i> Dokumen / File Imunisasi
                            </label>

                            <div class="border rounded-3 p-3 text-center bg-light">

                                {{-- PREVIEW FILE --}}
                                @if (Str::endsWith($data->file_name, ['.jpg', '.jpeg', '.png']))
                                    <img src="{{ asset('storage/imunisasi/' . $data->file_name) }}" class="img-fluid rounded mb-2"
                                        style="height:120px; object-fit:cover;">
                                @else
                                    <i class="fa fa-file-pdf fa-3x text-danger mb-2"></i>
                                @endif

                                {{-- NAMA FILE --}}
                                <p class="small text-muted text-truncate mb-2">
                                    {{ basename($data->file_name) }}
                                </p>

                                {{-- HAPUS LANGSUNG --}}
                                <a href="{{ route('imunisasi.deleteFile', $data->imunisasi_id) }}"
                                    class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus file ini?')">
                                    <i class="fa fa-trash me-1"></i> Hapus File
                                </a>

                            </div>
                        </div>
                    @endif

                    <input type="hidden" name="delete_file" id="delete_file" value="0">



                    <input type="hidden" name="delete_file" id="delete_file" value="0">

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-3 wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('imunisasi.index') }}" class="btn btn-outline-dark px-3 py-1">
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