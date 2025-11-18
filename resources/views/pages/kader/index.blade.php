@extends('layouts.guest.main')

@section('title', 'Data Kader')

@section('content')
<div class="py-5 bg-light d-flex justify-content-center">
    <div class="container">

        {{-- Judul --}}
        <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.2s">
            <h1 class="text-primary fw-bold">Data Kader Posyandu</h1>
            <p class="text-muted">Daftar kader yang terdaftar di setiap Posyandu.</p>
        </div>

        {{-- Tombol Tambah --}}
        <div class="d-flex justify-content-end mb-4 wow fadeInUp" data-wow-delay="0.3s">
            <a href="{{ route('kader.create') }}" class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
                <i class="fa fa-plus me-2"></i>Tambah Kader
            </a>
        </div>

        {{-- Pesan Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.4s">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Kartu Data Kader --}}
        <div class="row g-4">
            @forelse ($kader as $key => $k)
                <div class="col-md-4 col-lg-3 wow fadeInUp" data-wow-delay="{{ 0.4 + $key * 0.1 }}s">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                        {{-- Header --}}
                        <div class="text-center bg-primary text-white p-4 rounded-top">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($k->warga->nama) }}&background=0D6EFD&color=fff&rounded=true"
                                 alt="{{ $k->warga->nama }}"
                                 class="rounded-circle mb-3 border border-3 border-light shadow-sm"
                                 width="100" height="100">

                            <h5 class="fw-bold mb-1 text-white">{{ $k->warga->nama }}</h5>
                            <small class="text-white">Peran: {{ $k->peran }}</small>
                        </div>

                        {{-- Body --}}
                        <div class="card-body text-start px-4 py-3">
                            {{-- Posyandu --}}
                            <p class="mb-2 fs-6 text-dark">
                                <i class="fa-solid fa-house-medical text-primary me-2"></i>
                                <strong>Posyandu :</strong>
                                <span class="text-dark">{{ $k->posyandu->nama }}</span>
                            </p>

                            {{-- Mulai Tugas --}}
                            <p class="mb-2 fs-6 text-dark">
                                <i class="fa-solid fa-calendar-plus text-success me-2"></i>
                                <strong>Mulai Tugas :</strong>
                                <span class="text-dark">{{ $k->mulai_tugas }}</span>
                            </p>

                            {{-- Akhir Tugas --}}
                            <p class="mb-0 fs-6 text-dark">
                                <i class="fa-solid fa-calendar-xmark text-danger me-2"></i>
                                <strong>Akhir :</strong>
                                <span class="text-dark">{{ $k->akhir_tugas ?? '-' }}</span>
                            </p>
                        </div>

                        {{-- Tombol Edit & Hapus --}}
                        <div class="card-footer bg-transparent border-0 text-center pb-4">
                            <div class="d-flex justify-content-center align-items-center gap-3">
                                <a href="{{ route('kader.edit', $k->kader_id) }}"
                                   class="btn btn-primary btn-sm d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                   style="min-width: 90px; height: 38px;">
                                    <i class="fa fa-pen"></i> <span>Edit</span>
                                </a>

                                <form action="{{ route('kader.destroy', $k->kader_id) }}" method="POST"
                                      class="d-flex align-items-center m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus kader ini?')"
                                            class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                            style="min-width: 90px; height: 38px;">
                                        <i class="fa fa-trash"></i> <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center text-muted wow fadeInUp" data-wow-delay="0.5s">
                    Belum ada data Kader.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
