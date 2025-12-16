@extends('layouts.guest.main')

@section('title', 'Edit Warga')

@section('content')
    <div class="py-3 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp"
            style="max-width:600px; width:100%; background-color:#f9fafb;">
            <div class="card-body p-3">

                <!-- Header -->
                <div class="text-center mb-2 wow fadeInDown">
                    <img id="fotoPreview"
                        src="{{ old('foto_url', $warga->foto ? asset('storage/' . $warga->foto) : asset('assets/img/placeholder.png')) }}"
                        class="rounded-circle mb-2 shadow-sm border border-2 border-primary"
                        style="width:70px; height:70px; object-fit:cover;">

                    <h5 class="fw-bold mt-2 mb-1 text-primary">Edit Data Warga</h5>
                    <p class="text-muted mb-1" style="font-size:0.8rem;">
                        Perbarui informasi data warga
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
                <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST" enctype="multipart/form-data"
                    class="wow fadeInUp" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Upload Foto Profil -->
                    <div class="mb-2">
                        <label class="fw-semibold">Foto Profil</label>
                        <input type="file" name="foto"
                            class="form-control form-control-sm @error('foto') is-invalid @enderror" accept="image/*"
                            onchange="previewFoto(this)">

                        <small class="text-muted d-block" style="font-size:0.75rem;">
                            JPG / PNG • Opsional • Kosongkan jika tidak ingin mengganti foto
                        </small>
                        @error('foto')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- No KTP + Nama -->
                    <div class="row g-2 mb-1">
                        <div class="col-md-6">
                            <label class="fw-semibold">No KTP</label>
                            <input type="text" name="no_ktp"
                                class="form-control form-control-sm @error('no_ktp') is-invalid @enderror"
                                value="{{ old('no_ktp', $warga->no_ktp) }}" maxlength="16"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')" placeholder="16 digit No KTP"
                                required>
                            @error('no_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama"
                                class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $warga->nama) }}" placeholder="Nama lengkap" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Jenis Kelamin + Agama -->
                    <div class="row g-2 mb-1">
                        <div class="col-md-6">
                            <label class="fw-semibold">Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                class="form-select form-select-sm @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-semibold">Agama</label>
                            <select name="agama" class="form-select form-select-sm @error('agama') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih --</option>
                                @foreach(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $a)
                                    <option value="{{ $a }}" {{ old('agama', $warga->agama) == $a ? 'selected' : '' }}>{{ $a }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Pekerjaan + Telepon -->
                    <div class="row g-2 mb-1">
                        <div class="col-md-6">
                            <label class="fw-semibold">Pekerjaan</label>
                            <input type="text" name="pekerjaan"
                                class="form-control form-control-sm @error('pekerjaan') is-invalid @enderror"
                                value="{{ old('pekerjaan', $warga->pekerjaan) }}" placeholder="Pekerjaan">
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-semibold">No. Telepon</label>
                            <input type="text" name="telp"
                                class="form-control form-control-sm @error('telp') is-invalid @enderror"
                                value="{{ old('telp', $warga->telp) }}" maxlength="13" placeholder="Nomor HP"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            @error('telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-1">
                        <label class="fw-semibold">Email</label>
                        <input type="email" name="email"
                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                            value="{{ old('email', $warga->email) }}" placeholder="nama@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-center gap-2 mt-3">

                        <!-- Tombol Kembali -->
                        <a href="{{ route('warga.index') }}"
                            class="btn btn-outline-dark d-flex align-items-center justify-content-center gap-1"
                            style="min-width: 100px; height: 40px;">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>

                        <!-- Tombol Hapus Foto (jika ada) -->
                        @if ($warga->foto)
                            <button type="button"
                                class="btn btn-outline-danger d-flex align-items-center justify-content-center gap-1"
                                style="min-width: 100px; height: 40px;" onclick="hapusFoto({{ $warga->warga_id }})">
                                <i class="fa fa-trash"></i> Hapus Foto
                            </button>
                        @endif


                        <!-- Tombol Perbarui -->
                        <button type="submit"
                            class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-1"
                            style="min-width: 100px; height: 40px;">
                            <i class="fa fa-save"></i> Perbarui
                        </button>
                    </div>
            </div>
        </div>
    </div>

@endsection