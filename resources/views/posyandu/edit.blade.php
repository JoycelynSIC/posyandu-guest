@extends('layouts.main')

@section('title', 'editposyandu')

@section('content')
    {{-- Konten Utama --}}
    <div class="container py-5">
        <h3 class="text-center text-primary fw-bold mb-4">Edit Data Posyandu</h3>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Edit Data Posyandu --}}
        <div class="card shadow-sm p-4">
            <form action="{{ route('posyandu.store') }}" method="POST" novalidate>
                @csrf

                <div class="mb-3">
                    <label>Nama Posyandu</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $posyandu->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                        value="{{ old('alamat', $posyandu->alamat) }}" required>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>RT</label>
                        <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror"
                            value="{{ old('rt', $posyandu->rt) }}" required>
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>RW</label>
                        <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror"
                            value="{{ old('rw', $posyandu->rw) }}" required>
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label>Kontak</label>
                    <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror"
                        value="{{ old('kontak', $posyandu->kontak) }}" required>
                    @error('kontak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('posyandu.index') }}" class="btn btn-primary rounded-pill py-2 px-4" href="#">Kembali</a>
                    <button type="submit" class="btn btn-primary rounded-pill py-2 px-4" href="#">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
@endsection
