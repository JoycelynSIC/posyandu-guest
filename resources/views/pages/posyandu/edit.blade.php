@extends('layouts.guest.main')

@section('title', 'Edit Posyandu')

@section('content')
<div class="py-5 bg-light d-flex justify-content-center">
    <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
         style="max-width: 600px; width: 100%; background-color: #f9fafb;">
        <div class="card-body p-4">

            <!-- Header -->
            <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.1s">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                    style="width: 100px; height: 100px; background-color: #e3f2fd; color: #0d6efd;">
                    <i class="fas fa-clinic-medical fa-3x"></i>
                </div>
                <h4 class="fw-bold mt-3 mb-1 text-primary">Edit Data Posyandu</h4>
                <p class="text-muted mb-0">Perbarui informasi posyandu kamu di sini</p>
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

            <!-- Form Edit -->
            <form action="{{ route('posyandu.update', $posyandu->posyandu_id) }}" method="POST"
                  class="wow fadeInUp" data-wow-delay="0.3s" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="fw-semibold">Nama Posyandu</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $posyandu->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Alamat</label>
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                        value="{{ old('alamat', $posyandu->alamat) }}" required>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">RT</label>
                        <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror"
                            value="{{ old('rt', $posyandu->rt) }}" required>
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">RW</label>
                        <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror"
                            value="{{ old('rw', $posyandu->rw) }}" required>
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="fw-semibold">Kontak</label>
                    <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror"
                        value="{{ old('kontak', $posyandu->kontak) }}" required>
                    @error('kontak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4 wow fadeInUp" data-wow-delay="0.4s">
                    <a href="{{ route('posyandu.index') }}" class="btn btn-primary rounded-pill px-4">
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
