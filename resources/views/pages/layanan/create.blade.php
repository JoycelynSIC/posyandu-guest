@extends('layouts.guest.main')

@section('title', 'Tambah Layanan')

@section('content')
    <div class="py-3 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width:600px; width:100%; background-color:#f9fafb;">
            <div class="card-body p-3">

                <!-- Header -->
                <!-- Header -->
                <div class="text-center mb-2 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                        style="width:70px; height:70px; background-color:#e3f2fd; color:#0d6efd;">
                        <i class="fas fa-notes-medical fa-lg"></i>
                    </div>
                    <h5 class="fw-bold mt-2 mb-1 text-primary">Tambah Layanan</h5>
                    <p class="text-muted mb-1" style="font-size:0.8rem;">
                        Lengkapi form berikut untuk menambahkan data layanan warga
                    </p>
                </div>


                <!-- Error Validation -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s">
                        <ul class="mb-0" style="font-size:0.85rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('layanan.store') }}" method="POST" class="wow fadeInUp" data-wow-delay="0.3s">
                    @csrf
                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->jadwal_id }}">

                    <!-- Warga -->
                    <div class="mb-3">
                        <label class="fw-semibold d-flex align-items-center mb-1">
                            <i class="fa fa-user text-primary me-2"></i> Warga
                        </label>
                        <select name="warga_id"
                            class="form-select rounded-pill shadow-sm @error('warga_id') is-invalid @enderror" required
                            style="height:45px;">
                            <option value="">-- Pilih Warga --</option>
                            @foreach($warga as $w)
                                <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('warga_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Berat + Tinggi -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="fw-semibold"><i class="fa fa-weight-scale me-1 text-primary"></i> Berat
                                (kg)</label>
                            <input type="number" step="0.1" name="berat"
                                class="form-control @error('berat') is-invalid @enderror" value="{{ old('berat') }}"
                                placeholder="Contoh: 12.5" required>
                            @error('berat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold"><i class="fa fa-arrows-up-down me-1 text-primary"></i> Tinggi
                                (cm)</label>
                            <input type="number" step="0.1" name="tinggi"
                                class="form-control @error('tinggi') is-invalid @enderror" value="{{ old('tinggi') }}"
                                placeholder="Contoh: 85.5" required>
                            @error('tinggi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Vitamin -->
                    <div class="mb-3">
                        <label class="fw-semibold"><i class="fa fa-capsules me-1 text-primary"></i> Vitamin</label>
                        <input type="text" name="vitamin" class="form-control @error('vitamin') is-invalid @enderror"
                            value="{{ old('vitamin') }}" placeholder="Contoh: Vitamin A, C">
                        @error('vitamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konseling -->
                    <div class="mb-3">
                        <label class="fw-semibold"><i class="fa fa-comment-medical me-1 text-primary"></i> Konseling</label>
                        <select name="konseling" class="form-select @error('konseling') is-invalid @enderror" required>
                            <option value="1" {{ old('konseling') == '1' ? 'selected' : '' }}>Ya</option>
                            <option value="0" {{ old('konseling') == '0' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('konseling')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-3 wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ url()->previous() }}"
                            class="btn btn-primary rounded-pill px-3 py-1">
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