@extends('layouts.guest.main')

@section('title', 'Tambah Kader Posyandu')

@section('content')
<div class="py-3 bg-light d-flex justify-content-center">
    <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
         style="max-width:600px; width:100%; background-color:#f9fafb;">
        <div class="card-body p-3">

            <!-- Header -->
            <div class="text-center mb-2 wow fadeInDown" data-wow-delay="0.1s">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                     style="width:70px; height:70px; background-color:#e3f2fd; color:#0d6efd;">
                    <i class="fas fa-user-nurse fa-lg"></i>
                </div>
                <h5 class="fw-bold mt-2 mb-1 text-primary">Tambah Kader Posyandu</h5>
                <p class="text-muted mb-1" style="font-size:0.8rem;">Lengkapi form berikut untuk menambahkan kader baru</p>
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
            <form action="{{ route('kader.store') }}" method="POST" class="wow fadeInUp" data-wow-delay="0.3s" novalidate>
                @csrf

                <!-- Posyandu -->
                <div class="mb-2">
                    <label class="fw-semibold">Posyandu</label>
                    <select name="posyandu_id" class="form-select form-select-sm @error('posyandu_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Posyandu --</option>
                        @foreach ($posyandu as $pos)
                            <option value="{{ $pos->posyandu_id }}" {{ old('posyandu_id')==$pos->posyandu_id?'selected':'' }}>
                                {{ $pos->nama }} (RT {{ $pos->rt }}/RW {{ $pos->rw }})
                            </option>
                        @endforeach
                    </select>
                    @error('posyandu_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Warga -->
                <div class="mb-2">
                    <label class="fw-semibold">Nama Warga</label>
                    <select name="warga_id" class="form-select form-select-sm @error('warga_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Warga --</option>
                        @foreach ($warga as $w)
                            <option value="{{ $w->warga_id }}" {{ old('warga_id')==$w->warga_id?'selected':'' }}>
                                {{ $w->nama }} - {{ $w->no_ktp }}
                            </option>
                        @endforeach
                    </select>
                    @error('warga_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Peran -->
                <div class="mb-2">
                    <label class="fw-semibold">Peran Kader</label>
                    <select name="peran" class="form-select form-select-sm @error('peran') is-invalid @enderror" required>
                        <option value="">-- Pilih Peran --</option>
                        <option value="Ketua Kader" {{ old('peran')=='Ketua Kader'?'selected':'' }}>Ketua Kader</option>
                        <option value="Sekretaris" {{ old('peran')=='Sekretaris'?'selected':'' }}>Sekretaris</option>
                        <option value="Bendahara" {{ old('peran')=='Bendahara'?'selected':'' }}>Bendahara</option>
                        <option value="Kader Penimbangan" {{ old('peran')=='Kader Penimbangan'?'selected':'' }}>Kader Penimbangan</option>
                        <option value="Kader Penyuluhan" {{ old('peran')=='Kader Penyuluhan'?'selected':'' }}>Kader Penyuluhan</option>
                        <option value="Kader Imunisasi" {{ old('peran')=='Kader Imunisasi'?'selected':'' }}>Kader Imunisasi</option>
                    </select>
                    @error('peran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Tanggal Mulai & Akhir -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="fw-semibold">Mulai Tugas</label>
                        <input type="date" name="mulai_tugas" class="form-control form-control-sm @error('mulai_tugas') is-invalid @enderror"
                               value="{{ old('mulai_tugas') }}" required>
                        @error('mulai_tugas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold">Akhir Tugas (Opsional)</label>
                        <input type="date" name="akhir_tugas" class="form-control form-control-sm @error('akhir_tugas') is-invalid @enderror"
                               value="{{ old('akhir_tugas') }}">
                        @error('akhir_tugas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-2">
                    <a href="{{ route('kader.index') }}" class="btn btn-primary rounded-pill px-2 py-1">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-2 py-1">
                        <i class="fa fa-save me-1"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
