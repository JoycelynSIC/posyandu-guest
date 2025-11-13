@extends('layouts.guest.main')

@section('title', 'Edit Warga')

@section('content')
    <div class="py-5 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width: 700px; width: 100%; background-color: #f9fafb;">
            <div class="card-body p-4">

                <!-- Header -->
                {{-- Header Card dengan Icon --}}
                <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.2s">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle border border-3 border-primary shadow-sm mb-3"
                        style="width: 100px; height: 100px; background-color: #e8f0ff; color: #0d6efd;">
                        <i class="fas fa-id-card fa-3x"></i>
                    </div>
                    <h3 class="text-primary fw-bold mb-0">Edit Data Warga</h3>
                    <p class="text-muted mt-1">Perbarui informasi data warga dengan benar dan lengkap.</p>
                </div>

                {{-- Error Validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="wow fadeInLeft" data-wow-delay="0.25s">{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST" class="wow fadeInUp"
                    data-wow-delay="0.3s" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Row 1 -->
                    <div class="row mb-3">
                        <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.4s">
                            <label class="fw-semibold">No KTP</label>
                            <input type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror"
                                value="{{ old('no_ktp', $warga->no_ktp) }}" required>
                            @error('no_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 wow fadeInRight" data-wow-delay="0.5s">
                            <label class="fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $warga->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="row mb-3">
                        <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.6s">
                            <label class="fw-semibold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 wow fadeInRight" data-wow-delay="0.7s">
                            <label class="fw-semibold">Agama</label>
                            <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam" {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam
                                </option>
                                <option value="Kristen Protestan" {{ old('agama', $warga->agama) == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                <option value="Katolik" {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>
                                    Katolik</option>
                                <option value="Hindu" {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>
                                <option value="Buddha" {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha
                                </option>
                                <option value="Konghucu" {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>
                                    Konghucu</option>
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="row mb-3">
                        <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.8s">
                            <label class="fw-semibold">Pekerjaan</label>
                            <input type="text" name="pekerjaan"
                                class="form-control @error('pekerjaan') is-invalid @enderror"
                                value="{{ old('pekerjaan', $warga->pekerjaan) }}" required>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 wow fadeInRight" data-wow-delay="0.9s">
                            <label class="fw-semibold">No. Telepon</label>
                            <input type="text" name="telp" class="form-control @error('telp') is-invalid @enderror"
                                value="{{ old('telp', $warga->telp) }}" required>
                            @error('telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="mb-3 wow fadeInUp" data-wow-delay="1s">
                        <label class="fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $warga->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-4 wow fadeInUp" data-wow-delay="1.1s">
                        <a href="{{ route('warga.index') }}" class="btn btn-primary rounded-pill px-4">
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