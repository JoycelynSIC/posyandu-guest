@extends('layouts.guest.main')

@section('title', 'Jadwal Posyandu')

@section('content')
<div class="py-5 bg-light">
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-5 wow fadeInDown" data-wow-delay="0.1s">
            <h1 class="fw-bold text-primary mb-2" style="font-size:2.5rem;">Jadwal Posyandu</h1>
            <p class="text-muted fs-5">Daftar kegiatan Posyandu yang akan dilaksanakan</p>
        </div>

        {{-- Filter --}}
        <form method="GET" class="row g-3 mb-4 wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control shadow-sm" 
                    placeholder="Cari tema / keterangan" value="{{ request('search') }}">
            </div>
            <div class="col-md-5">
                <select name="posyandu_id" class="form-select shadow-sm">
                    <option value="">Semua Posyandu</option>
                    @foreach($posyandu as $p)
                        <option value="{{ $p->posyandu_id }}" 
                            {{ request('posyandu_id') == $p->posyandu_id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol Go & Clear --}}
            <div class="col-12 d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-primary shadow-sm rounded-pill flex-fill py-2 px-3">
                    Go
                </button>
                @if(request('search') || request('posyandu_id'))
                    <a href="{{ route('jadwal.index') }}" 
                        class="btn btn-outline-primary shadow-sm rounded-pill flex-fill py-2 px-3 
                               d-flex align-items-center justify-content-center">
                        Clear
                    </a>
                @endif
            </div>
        </form>

        {{-- Tombol Tambah --}}
        <div class="text-end mb-4 wow fadeInUp" data-wow-delay="0.25s">
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                <i class="fa fa-plus me-2"></i> Tambah Jadwal
            </a>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show wow fadeInUp" 
                 data-wow-delay="0.3s" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Cards Jadwal --}}
        <div class="row g-4">
            @forelse($jadwal as $j)
                <div class="col-md-6 col-lg-4 wow fadeInUp">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                        {{-- Poster --}}
                        @if($j->poster())
                            <img src="{{ asset('storage/' . $j->poster()->file_url) }}" 
                                 class="card-img-top" 
                                 alt="Poster {{ $j->tema }}" 
                                 style="height:140px; object-fit:cover;">
                        @endif

                        {{-- Card Body --}}
                        <div class="card-body py-2 px-3">
                            <span class="badge bg-primary mb-1 px-2 py-1 rounded-pill" 
                                  style="font-size:0.75rem;">
                                {{ \Carbon\Carbon::parse($j->tanggal)->translatedFormat('d F Y') }}
                            </span>

                            <h6 class="fw-bold text-dark mt-1" style="font-size:0.95rem;">
                                {{ $j->tema }}
                            </h6>

                            <p class="small text-primary mb-1" style="font-size:0.8rem;">
                                <i class="fa fa-hospital me-1"></i>{{ $j->posyandu->nama }}
                            </p>

                            <p class="small text-dark mb-0" style="font-size:0.8rem;">
                                {{ Str::limit($j->keterangan, 80) ?? '-' }}
                            </p>
                        </div>

                        {{-- Card Footer --}}
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-center gap-2 pb-2">

                            {{-- Detail --}}
                            <a href="{{ route('jadwal.show', $j->jadwal_id) }}" 
                               class="btn btn-outline-dark d-flex align-items-center justify-content-center gap-1 shadow-sm" 
                               style="min-width: 100px; height:36px;">
                                <i class="fa fa-eye me-1"></i> Detail
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('jadwal.edit', $j->jadwal_id) }}" 
                               class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-1 shadow-sm" 
                               style="min-width: 100px; height:36px;">
                                <i class="fa fa-pen me-1"></i> Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('jadwal.destroy', $j->jadwal_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Yakin ingin menghapus jadwal ini?')" 
                                        class="btn btn-outline-danger d-flex align-items-center justify-content-center gap-1 shadow-sm" 
                                        style="min-width: 100px; height:36px;">
                                    <i class="fa fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center text-muted wow fadeInUp">
                    Belum ada jadwal
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $jadwal->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
@endsection
