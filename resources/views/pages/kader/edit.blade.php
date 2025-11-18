@extends('layouts.guest.main')

@section('title', 'Edit Kader Posyandu')

@section('content')
    <div class="py-5 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width: 700px; width: 100%; background-color: #f9fafb;">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.2s">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle border border-3 border-primary shadow-sm mb-3"
                        style="width: 100px; height: 100px; background-color: #e8f0ff; color: #0d6efd;">
                        <i class="fas fa-user-nurse fa-3x"></i>
                    </div>
                    <h3 class="text-primary fw-bold mb-0">Edit Data Kader Posyandu</h3>
                    <p class="text-muted mt-1">Perbarui informasi kader dengan benar dan lengkap.</p>
                </div>

                {{-- Error Validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.3s">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="wow fadeInLeft" data-wow-delay="0.25s">{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('kader.update', $kader->kader_id) }}" method="POST"
                    class="wow fadeInUp" data-wow-delay="0.4s" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Posyandu -->
                    <div class="mb-3 wow fadeInLeft" data-wow-delay="0.5s">
                        <label class="fw-semibold">Posyandu</label>
                        <select name="posyandu_id" class="form-select @error('posyandu_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Posyandu --</option>
                            @foreach ($posyandu as $pos)
                                <option value="{{ $pos->posyandu_id }}"
                                    {{ old('posyandu_id', $kader->posyandu_id) == $pos->posyandu_id ? 'selected' : '' }}>
                                    {{ $pos->nama }} (RT {{ $pos->rt }}/RW {{ $pos->rw }})
                                </option>
                            @endforeach
                        </select>
                        @error('posyandu_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Warga -->
                    <div class="mb-3 wow fadeInRight" data-wow-delay="0.6s">
                        <label class="fw-semibold">Nama Warga</label>
                        <select name="warga_id" class="form-select @error('warga_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Warga --</option>
                            @foreach ($warga as $w)
                                <option value="{{ $w->warga_id }}"
                                    {{ old('warga_id', $kader->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }} - {{ $w->no_ktp }}
                                </option>
                            @endforeach
                        </select>
                        @error('warga_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Peran -->
                    <div class="mb-3 wow fadeInLeft" data-wow-delay="0.7s">
                        <label class="fw-semibold">Peran</label>
                        <select name="peran" class="form-select @error('peran') is-invalid @enderror" required>
                            <option value="">-- Pilih Peran --</option>
                            <option value="Ketua Kader" {{ old('peran', $kader->peran)=='Ketua Kader' ? 'selected':'' }}>Ketua Kader</option>
                            <option value="Sekretaris" {{ old('peran', $kader->peran)=='Sekretaris' ? 'selected':'' }}>Sekretaris</option>
                            <option value="Bendahara" {{ old('peran', $kader->peran)=='Bendahara' ? 'selected':'' }}>Bendahara</option>
                            <option value="Kader Penimbangan" {{ old('peran', $kader->peran)=='Kader Penimbangan' ? 'selected':'' }}>Kader Penimbangan</option>
                            <option value="Kader Penyuluhan" {{ old('peran', $kader->peran)=='Kader Penyuluhan' ? 'selected':'' }}>Kader Penyuluhan</option>
                            <option value="Kader Imunisasi" {{ old('peran', $kader->peran)=='Kader Imunisasi' ? 'selected':'' }}>Kader Imunisasi</option>
                        </select>
                        @error('peran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div class="row mb-3">
                        <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.8s">
                            <label class="fw-semibold">Mulai Tugas</label>
                            <input type="date" name="mulai_tugas"
                                class="form-control @error('mulai_tugas') is-invalid @enderror"
                                value="{{ old('mulai_tugas', $kader->mulai_tugas) }}" required>
                            @error('mulai_tugas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 wow fadeInRight" data-wow-delay="0.9s">
                            <label class="fw-semibold">Akhir Tugas (Opsional)</label>
                            <input type="date" name="akhir_tugas"
                                class="form-control @error('akhir_tugas') is-invalid @enderror"
                                value="{{ old('akhir_tugas', $kader->akhir_tugas) }}">
                            @error('akhir_tugas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-4 wow fadeInUp" data-wow-delay="1s">
                        <a href="{{ route('kader.index') }}" class="btn btn-primary rounded-pill px-4">
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
