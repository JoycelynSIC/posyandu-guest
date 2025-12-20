@extends('layouts.guest.main')

@section('title', 'Tambah Catatan Imunisasi')

@section('content')
    <div class="py-2 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp"
            style="max-width:550px; width:100%; background-color:#f9fafb;">
            <div class="card-body p-3">

                <!-- Header -->
                <div class="text-center mb-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                        style="width:60px; height:60px; background-color:#e3f2fd; color:#0d6efd;">
                        <i class="fas fa-syringe fa-lg"></i>
                    </div>
                    <h5 class="fw-bold mt-2 mb-1 text-primary">Tambah Catatan Imunisasi</h5>
                </div>

                <!-- Error -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" style="font-size:0.85rem;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('imunisasi.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="row g-2">
                        <!-- Warga -->
                        <div class="col-12">
                            <label class="fw-semibold"><i class="fa fa-user me-1 text-primary"></i> Warga</label>
                            <select name="warga_id"
                                class="form-select form-select-sm @error('warga_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                    </option>

                                    {{ $w->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('warga_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Jenis Vaksin -->
                        <div class="col-12">
                            <label class="fw-semibold"><i class="fa fa-virus me-1 text-primary"></i> Jenis Vaksin</label>
                            <input type="text" name="jenis_vaksin"
                                class="form-control form-control-sm @error('jenis_vaksin') is-invalid @enderror"
                                value="{{ old('jenis_vaksin') }}" placeholder="Contoh: MR, Polio" required>
                            @error('jenis_vaksin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Tanggal & Lokasi -->
                        <div class="col-md-6">
                            <label class="fw-semibold"><i class="fa fa-calendar-days me-1 text-primary"></i> Tanggal</label>
                            <input type="date" name="tanggal"
                                class="form-control form-control-sm @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal') }}" required>
                            @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold"><i class="fa fa-map-marker-alt me-1 text-primary"></i> Lokasi</label>
                            <input type="text" name="lokasi"
                                class="form-control form-control-sm @error('lokasi') is-invalid @enderror"
                                value="{{ old('lokasi') }}" placeholder="Contoh: Posyandu Melati">
                            @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Nakes & File -->
                        <div class="col-md-6">
                            <label class="fw-semibold"><i class="fa fa-user-md me-1 text-primary"></i> Petugas Nakes</label>
                            <input type="text" name="nakes"
                                class="form-control form-control-sm @error('nakes') is-invalid @enderror"
                                value="{{ old('nakes') }}" placeholder="Nama petugas">
                            @error('nakes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold"><i class="fa fa-file-upload me-1 text-primary"></i> File</label>
                            <input type="file" name="file_name"
                                class="form-control form-control-sm @error('file_name') is-invalid @enderror"
                                accept=".jpg,.jpeg,.png,.pdf">
                            @error('file_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('imunisasi.index') }}" class="btn btn-primary rounded-pill px-3 py-1">
                            <i class="fa fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-3 py-1">
                            <i class="fa fa-save me-1"></i> Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection