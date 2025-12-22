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
        <form method="GET" class="wow fadeInUp mb-4" data-wow-delay="0.2s">
    <div class="row g-3">
        {{-- Input Search --}}
        <div class="col-md-5">
            <label class="form-label fw-bold mb-1">Temukan</label>
            <input type="text" name="search" class="form-control shadow-sm"
                placeholder="Cari tema / keterangan" value="{{ request('search') }}">
        </div>

        {{-- Filter Dropdown --}}
        <div class="col-md-5">
            <label class="form-label fw-bold mb-1">Posyandu</label>
            <select name="posyandu_id" class="form-select shadow-sm">
                <option value="">Semua Posyandu</option>
                @foreach ($posyandu as $p)
                    <option value="{{ $p->posyandu_id }}"
                        {{ request('posyandu_id') == $p->posyandu_id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Tombol Go & Clear tetap di bawah, tidak disentuh --}}
    <div class="col-12 d-flex gap-2 mt-3">
        <button type="submit" class="btn btn-primary shadow-sm rounded-pill flex-fill py-2 px-3">Go</button>
        @if (request('search') || request('posyandu_id'))
            <a href="{{ route('jadwal.index') }}"
                class="btn btn-outline-primary shadow-sm rounded-pill flex-fill py-2 px-3 d-flex align-items-center justify-content-center">
                Clear
            </a>
        @endif
    </div>
</form>


        {{-- Tombol Tambah --}}
        @auth
            @if (auth()->user()->role === 'admin')
                <div class="text-end mb-4 wow fadeInUp" data-wow-delay="0.25s">
                    <a href="{{ route('jadwal.create') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                        <i class="fa fa-plus me-2"></i> Tambah Jadwal
                    </a>
                </div>
            @endif
        @endauth

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.3s">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Cards Jadwal --}}
        <div class="row g-4">
            @forelse ($jadwal as $j)
                <div class="col-md-6 col-lg-4 wow fadeInUp">
                    <div class="card h-100 rounded-4 border-0 overflow-hidden shadow-sm"
                        style="transition: transform 0.3s; cursor:pointer;"
                        onmouseover="this.style.transform='translateY(-6px)'"
                        onmouseout="this.style.transform='translateY(0)'">

                        <img src="{{ $j->poster() ? asset('storage/' . $j->poster()->file_name) : asset('assets/img/placeholderimg.png') }}"
                            class="card-img-top" alt="Poster {{ $j->tema }}"
                            style="height:140px; object-fit:cover;">

                        <div class="card-body py-2 px-3">
                            <span class="badge bg-primary mb-1 px-2 py-1 rounded-pill" style="font-size:0.75rem;">
                                {{ \Carbon\Carbon::parse($j->tanggal)->translatedFormat('d F Y') }}
                            </span>

                            <h6 class="fw-bold text-dark mt-1" style="font-size:0.95rem;">{{ $j->tema }}</h6>

                            <p class="small text-primary mb-1" style="font-size:0.8rem;">
                                <i class="fa fa-hospital me-1"></i>{{ $j->posyandu->nama }}
                            </p>

                            <p class="small text-dark mb-0" style="font-size:0.8rem;">
                                {{ Str::limit($j->keterangan, 80) ?? '-' }}
                            </p>
                        </div>

                        <div class="card-footer bg-transparent border-0 d-flex justify-content-center gap-2 flex-wrap pb-2">
                            <a href="{{ route('jadwal.show', $j->jadwal_id) }}"
                                class="btn btn-outline-dark d-flex align-items-center gap-1 shadow-sm"
                                style="min-width:90px; height:36px;">
                                <i class="fa fa-eye me-1"></i> Detail
                            </a>

                            @auth
                               @if(auth()->user()->role === 'admin')
                           	 <a href="{{ route('layanan.index', ['jadwal_id' => $j->jadwal_id]) }}"
                               	        class="btn btn-outline-dark d-flex align-items-center gap-1 shadow-sm"
                                        style="min-width:110px; height:36px;">
                                        <i class="fa fa-clock-rotate-left me-1"></i> Riwayat Layanan
                                 </a>
                                 <a href="{{ route('jadwal.edit', $j->jadwal_id) }}"
                                        class="btn btn-outline-primary d-flex align-items-center gap-1 shadow-sm"
                                        style="min-width:90px; height:36px;">
                                        <i class="fa fa-pen me-1"></i> Edit
                                 </a>

                                    <form action="{{ route('jadwal.destroy', $j->jadwal_id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                            class="btn btn-outline-danger d-flex align-items-center gap-1 shadow-sm"
                                            style="min-width:90px; height:36px;">
                                            <i class="fa fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted wow fadeInUp">Belum ada jadwal</div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $jadwal->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
@endsection
