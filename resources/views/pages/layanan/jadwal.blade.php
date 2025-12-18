@extends('layouts.guest.main')

@section('title', 'Riwayat Layanan Jadwal')

@section('content')
<div class="py-5 bg-light">
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary mb-2">Riwayat Layanan</h1>
            <p class="text-muted fs-5">
                Jadwal: {{ $jadwal->tema }} - {{ $jadwal->posyandu->nama }}
            </p>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('layanan.jadwal', $jadwal->jadwal_id) }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama warga..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-12 d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary flex-fill">Go</button>
                    @if(request('search'))
                        <a href="{{ route('layanan.jadwal', $jadwal->jadwal_id) }}" class="btn btn-outline-primary flex-fill">Clear</a>
                    @endif
                </div>
            </div>
        </form>

        {{-- Cards --}}
        <div class="row g-4">
            @forelse($layanan as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm rounded-4">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">
                                {{ \Carbon\Carbon::parse($item->jadwal->tanggal)->translatedFormat('d F Y') }}
                            </span>
                            <h6 class="fw-bold mb-1">{{ $item->warga->nama ?? '-' }}</h6>
                            <hr>
                            <p class="mb-1"><strong>Berat:</strong> {{ $item->berat ?? '-' }} kg</p>
                            <p class="mb-1"><strong>Tinggi:</strong> {{ $item->tinggi ?? '-' }} cm</p>
                            <p class="mb-1"><strong>Vitamin:</strong> {{ $item->vitamin ?? '-' }}</p>
                            <p class="mb-0">
                                <strong>Konseling:</strong>
                                <span class="badge {{ $item->konseling ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $item->konseling ? 'Ya' : 'Tidak' }}
                                </span>
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('jadwal.show', $item->jadwal_id) }}" class="btn btn-outline-primary btn-sm">Detail Jadwal</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">Belum ada riwayat layanan untuk jadwal ini.</div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $layanan->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
@endsection
