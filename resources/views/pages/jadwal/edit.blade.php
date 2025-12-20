@extends('layouts.guest.main')

@section('title', 'Edit Jadwal Posyandu')

@section('content')
    <div class="py-3 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width:600px; width:100%; background-color:#f9fafb;">
            <div class="card-body p-3">

                <!-- Header -->
                <div class="text-center mb-2 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                        style="width:70px; height:70px; background-color:#e3f2fd; color:#0d6efd;">
                        <i class="fa fa-calendar-alt fa-lg"></i>
                    </div>

                    <h5 class="fw-bold mt-2 mb-1 text-primary">Edit Jadwal Posyandu</h5>
                    <p class="text-muted mb-1" style="font-size:0.8rem;">Perbarui data jadwal kegiatan</p>
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
                <form action="{{ route('jadwal.update', $jadwal->jadwal_id) }}" method="POST" enctype="multipart/form-data" class="wow fadeInUp" data-wow-delay="0.3s" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Poster Kegiatan -->
                    <div class="mb-2">
                        <label class="fw-semibold"><i class="fa fa-image me-1 text-primary"></i> Poster Kegiatan (Opsional)</label>
                        @php
                            $poster = \App\Models\Media::where('ref_table', 'jadwal')
                                ->where('ref_id', $jadwal->jadwal_id)
                                ->latest()
                                ->first();
                        @endphp
                        @if($poster)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $poster->file_name) }}" alt="Poster Saat Ini"
                                    class="img-fluid rounded" style="max-height:120px; object-fit:cover;">
                            </div>
                        @endif
                        <input type="file" name="poster" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted d-block" style="font-size:0.75rem;">JPG / PNG • Opsional</small>
                    </div>

                    <!-- Posyandu -->
                    <div class="mb-1">
                        <label class="fw-semibold"><i class="fa fa-clinic-medical me-1 text-primary"></i> Posyandu</label>
                        <select name="posyandu_id" class="form-select form-select-sm @error('posyandu_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Posyandu --</option>
                            @foreach ($posyandu as $p)
                                <option value="{{ $p->posyandu_id }}" {{ $jadwal->posyandu_id == $p->posyandu_id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('posyandu_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-1">
                        <label class="fw-semibold"><i class="fa fa-calendar-alt me-1 text-primary"></i> Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}"
                            class="form-control form-control-sm @error('tanggal') is-invalid @enderror" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tema -->
                    <div class="mb-1">
                        <label class="fw-semibold"><i class="fa fa-book-open me-1 text-primary"></i> Tema Kegiatan</label>
                        <input type="text" name="tema" value="{{ $jadwal->tema }}"
                            class="form-control form-control-sm @error('tema') is-invalid @enderror"
                            placeholder="Contoh: Imunisasi & Penimbangan" required>
                        @error('tema')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-1">
                        <label class="fw-semibold"><i class="fa fa-info-circle me-1 text-primary"></i> Keterangan</label>
                        <textarea name="keterangan" rows="2"
                            class="form-control form-control-sm @error('keterangan') is-invalid @enderror"
                            placeholder="Keterangan tambahan (opsional)">{{ $jadwal->keterangan }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-2 wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-primary rounded-pill px-2 py-1">
                            <i class="fa fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-2 py-1">
                            <i class="fa fa-save me-1"></i> Perbarui
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
