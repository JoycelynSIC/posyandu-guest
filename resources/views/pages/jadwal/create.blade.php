@extends('layouts.guest.main')

@section('title', 'Tambah Jadwal Posyandu')

@section('content')
<div class="py-3 bg-light d-flex justify-content-center">
    <div class="card shadow-sm border-0 rounded-4 wow fadeInUp"
         data-wow-delay="0.1s"
         style="max-width:600px; width:100%; background-color:#f9fafb;">
        <div class="card-body p-3">

            <!-- Header -->
            <div class="text-center mb-2 wow fadeInDown" data-wow-delay="0.1s">
                <img id="posterPreview"
                     src="{{ asset('assets/img/placeholder.png') }}"
                     class="rounded mb-2 shadow-sm border border-2 border-primary"
                     style="width:90px; height:90px; object-fit:cover;">

                <h5 class="fw-bold mt-2 mb-1 text-primary">Tambah Jadwal Posyandu</h5>
                <p class="text-muted mb-1" style="font-size:0.8rem;">
                    Isi form berikut untuk menambahkan jadwal kegiatan
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
            <form action="{{ route('jadwal.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="wow fadeInUp"
                  data-wow-delay="0.3s"
                  novalidate>
                @csrf

                <!-- Poster Kegiatan -->
                <div class="mb-2">
                    <label class="fw-semibold">Poster Kegiatan</label>
                    <input type="file"
                           name="poster"
                           class="form-control form-control-sm @error('poster') is-invalid @enderror"
                           accept="image/*"
                           onchange="previewPoster(this)">
                    <small class="text-muted" style="font-size:0.75rem;">
                        JPG / PNG • Opsional
                    </small>
                    @error('poster')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Posyandu -->
                <div class="mb-1">
                    <label class="fw-semibold">Posyandu</label>
                    <select name="posyandu_id"
                            class="form-select form-select-sm @error('posyandu_id') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Posyandu --</option>
                        @foreach ($posyandu as $p)
                            <option value="{{ $p->posyandu_id }}"
                                {{ old('posyandu_id') == $p->posyandu_id ? 'selected' : '' }}>
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
                    <label class="fw-semibold">Tanggal Kegiatan</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control form-control-sm @error('tanggal') is-invalid @enderror"
                           value="{{ old('tanggal') }}"
                           required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tema -->
                <div class="mb-1">
                    <label class="fw-semibold">Tema Kegiatan</label>
                    <input type="text"
                           name="tema"
                           class="form-control form-control-sm @error('tema') is-invalid @enderror"
                           value="{{ old('tema') }}"
                           placeholder="Contoh: Imunisasi & Penimbangan"
                           required>
                    @error('tema')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="mb-1">
                    <label class="fw-semibold">Keterangan</label>
                    <textarea name="keterangan"
                              rows="2"
                              class="form-control form-control-sm @error('keterangan') is-invalid @enderror"
                              placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
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
                        <i class="fa fa-save me-1"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Preview Poster -->
<script>
function previewPoster(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('posterPreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
