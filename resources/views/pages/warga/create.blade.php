@extends('layouts.main')

@section('title', 'Tambah Warga')

@section('content')
<div class=" py-5 bg-light d-flex justify-content-center" >
    <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
         style="max-width: 700px; width: 100%; background-color: #f9fafb;">
        <div class="card-body p-4">

            <!-- Header -->
            <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.1s">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                     style="width: 100px; height: 100px; background-color: #e3f2fd; color: #0d6efd;">
                    <i class="fas fa-users fa-3x"></i>
                </div>
                <h4 class="fw-bold mt-3 mb-1 text-primary">Tambah Data Warga</h4>
                <p class="text-muted mb-0">Isi form berikut untuk menambahkan data warga baru</p>
            </div>

            <!-- Tampilkan error validasi -->
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

            <!-- Form Create -->
            <form action="{{ route('warga.store') }}" method="POST" class="wow fadeInUp" data-wow-delay="0.3s" novalidate>
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">No KTP</label>
                        <input type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror"
                               value="{{ old('no_ktp') }}" maxlength="16"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               placeholder="Masukkan 16 digit No KTP" required>
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}"placeholder="Masukkan nama lengkap" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">Agama</label>
                        <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen Protestan" {{ old('agama') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror"
                               value="{{ old('pekerjaan') }}" placeholder="Masukkan pekerjaan">
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">No. Telepon</label>
                        <input type="text" name="telp" class="form-control @error('telp') is-invalid @enderror"
                               value="{{ old('telp') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               maxlength="13" placeholder="Masukkan nomor HP">
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="Contoh: nama@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4 wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('warga.index') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fa fa-save me-1"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
