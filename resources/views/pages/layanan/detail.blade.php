@extends('layouts.guest.main')

@section('title', 'Edit Layanan')

@section('content')
    <div class="py-5 bg-light">
        <div class="container">

            <div class="text-center mb-4">
                <h4 class="fw-bold text-primary">Edit Layanan</h4>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">

                    <form action="{{ route('layanan.update', $layanan->layanan_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="fw-semibold">Warga</label>
                            <input type="text" class="form-control" value="{{ $layanan->warga->nama }}" disabled>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-semibold">Berat</label>
                                <input type="number" step="0.1" name="berat" class="form-control"
                                    value="{{ $layanan->berat }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">Tinggi</label>
                                <input type="number" step="0.1" name="tinggi" class="form-control"
                                    value="{{ $layanan->tinggi }}" required>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="fw-semibold">Vitamin</label>
                            <input type="text" name="vitamin" class="form-control" value="{{ $layanan->vitamin }}">
                        </div>

                        <div class="mt-3">
                            <label class="fw-semibold">Konseling</label>
                            <select name="konseling" class="form-select">
                                <option value="1" {{ $layanan->konseling ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ !$layanan->konseling ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('layanan.show', $layanan->layanan_id) }}" class="btn btn-outline-dark">
                                Batal
                            </a>
                            <button class="btn btn-primary">Perbarui</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection