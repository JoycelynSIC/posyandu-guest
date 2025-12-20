@extends('layouts.guest.main')

@section('title', 'Riwayat Layanan Jadwal')

@section('content')
    <div class="py-5 bg-light">
        <div class="container">

            {{-- Header --}}
            <div class="text-center mb-5 wow fadeInDown" data-wow-delay="0.1s">
                <h1 class="fw-bold text-primary mb-2">Riwayat Layanan</h1>
                <p class="text-muted fs-5">
                    Jadwal: {{ $jadwal->tema }} - {{ $jadwal->posyandu->nama }}
                </p>
            </div>


            {{-- Search + Tombol Kembali --}}
           <form method="GET" action="{{ route('layanan.jadwal', $jadwal->jadwal_id) }}" class="mb-4 wow fadeInUp"
    data-wow-delay="0.15s">
    <div class="row g-3 align-items-end">
        {{-- Search --}}
        <div class="col-md-6">
            <label class="form-label fw-bold">Temukan</label>
            <input type="text" name="search" class="form-control shadow-sm" placeholder="Cari nama warga..."
                value="{{ request('search') }}">
        </div>

        {{-- Tombol Go & Clear --}}
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill">Go</button>
            @if(request('search'))
                <a href="{{ route('layanan.jadwal', $jadwal->jadwal_id) }}"
                    class="btn btn-outline-primary flex-fill">Clear</a>
            @endif
        </div>

        {{-- Tombol Kembali --}}
        <div class="col-md-3">
            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-primary w-100">
                <i class="fa fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</form>


            {{-- Tombol Tambah Layanan --}}
            @auth
                @if(auth()->user()->role == 'admin')
                    <div class="text-end mb-4 wow fadeInUp" data-wow-delay="0.25s">
                        <a href="{{ route('layanan.create', $jadwal->jadwal_id) }}"
                            class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                            <i class="fa fa-plus me-2"></i> Tambah Layanan
                        </a>
                    </div>
                @endif
            @endauth



            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Cards Layanan --}}
            <div class="row g-4">
                @forelse($layanan as $item)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card h-100 rounded-4 border-0 overflow-hidden"
                            style="transition: transform 0.3s; cursor: pointer;"
                            onmouseover="this.style.transform='translateY(-6px)';"
                            onmouseout="this.style.transform='translateY(0)';">


                            {{-- Header Tanggal --}}
                            <div class="card-header bg-primary text-white text-center fw-bold fs-6">
                                <i class="fa fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($item->jadwal->tanggal)->translatedFormat('d F Y') }}
                            </div>

                            <div class="card-body p-4">
                                {{-- Nama Warga --}}
                                <h6 class="fw-bold mb-3 text-primary">
                                    <i class="fa fa-user me-2"></i> {{ $item->warga->nama ?? '-' }}
                                </h6>

                                {{-- Jadwal --}}
                                <p class="small text-muted mb-3">
                                    <i class="fa fa-clipboard-list me-2 text-primary"></i>
                                    {{ $item->jadwal->tema }} - {{ $item->jadwal->posyandu->nama }}
                                </p>

                                {{-- Data Layanan --}}
                                <p class="mb-2">
                                    <i class="fa-solid fa-weight-scale me-2 text-primary"></i>
                                    <strong>Berat:</strong> {{ $item->berat ?? '-' }} kg
                                </p>
                                <p class="mb-2">
                                    <i class="fa-solid fa-arrows-up-down me-2 text-primary"></i>
                                    <strong>Tinggi:</strong> {{ $item->tinggi ?? '-' }} cm
                                </p>
                                <p class="mb-2">
                                    <i class="fa-solid fa-capsules me-2 text-primary"></i>
                                    <strong>Vitamin:</strong> {{ $item->vitamin ?? '-' }}
                                </p>
                                <p class="mb-0">
                                    <i class="fa-solid fa-comment-medical me-2 text-primary"></i>
                                    <strong>Konseling:</strong>
                                    <span class="badge {{ $item->konseling ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->konseling ? 'Ya' : 'Tidak' }}
                                    </span>
                                </p>

                            </div>

                            {{-- Footer --}}
                            <div
                                class="card-footer text-center bg-primary border-0 pt-2 pb-2 d-flex justify-content-center align-items-center gap-2">

                                <div
                                    class="card-footer text-center bg-primary border-0 pt-2 pb-2 d-flex justify-content-center align-items-center gap-2">

                                    {{-- Hanya admin bisa Edit & Hapus --}}
                                    @auth
                                        @if(auth()->user()->role == 'admin')
                                            {{-- Edit --}}
                                            <a href="{{ route('layanan.edit', $item->layanan_id) }}"
                                                class="btn btn-outline-light btn-sm shadow-sm">
                                                <i class="fa fa-edit me-1"></i> Edit
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('layanan.destroy', $item->layanan_id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus layanan ini?');"
                                                class="d-inline m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-light btn-sm shadow-sm">
                                                    <i class="fa fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    @endauth

                                </div>


                            </div>


                        </div>
                    </div>

                @empty
                    <div class="col-12 text-center text-muted wow fadeInUp" data-wow-delay="0.25s">
                        Belum ada riwayat layanan untuk jadwal ini.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4 wow fadeInUp" data-wow-delay="0.3s">
                {{ $layanan->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
@endsection