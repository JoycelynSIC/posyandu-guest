@extends('layouts.guest.main')

@section('title', 'indexposyandu')

@section('content')
<div class="py-5 bg-light d-flex justify-content-center">
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.2s">
            <h1 class="text-primary fw-bold">Data Posyandu</h1>
            <p class="text-muted">Daftar seluruh Posyandu yang terdaftar di sistem.</p>
        </div>

        {{-- FILTER --}}
       <form method="GET" action="{{ route('posyandu.index') }}" class="wow fadeInUp mb-4 mt-3" data-wow-delay="0.25s">
    <div class="row g-3">

        {{-- Search global --}}
        <div class="col-md-6">
            <label class="form-label fw-bold">Search</label>
            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Cari nama atau alamat...">
        </div>

        {{-- Filter RT --}}
        <div class="col-md-3">
            <label class="form-label fw-bold">RT</label>
            <select name="rt" class="form-select">
                <option value="">Semua RT</option>
                @foreach(range(1, 10) as $rt)
                    <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>{{ $rt }}</option>
                @endforeach
            </select>
        </div>

        {{-- Filter RW --}}
        <div class="col-md-3">
            <label class="form-label fw-bold">RW</label>
            <select name="rw" class="form-select">
                <option value="">Semua RW</option>
                @foreach(range(1, 5) as $rw)
                    <option value="{{ $rw }}" {{ request('rw') == $rw ? 'selected' : '' }}>{{ $rw }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Go & Clear --}}
        <div class="col-12 d-flex gap-2 mt-2">
            <button type="submit" class="btn btn-primary shadow-sm rounded-pill flex-fill py-2 px-3">Go</button>
            @if(request('search') || request('rt') || request('rw'))
                <a href="{{ route('posyandu.index') }}" 
                   class="btn btn-outline-primary shadow-sm rounded-pill flex-fill py-2 px-3 d-flex align-items-center justify-content-center">
                   Clear
                </a>
            @endif
        </div>

    </div>
</form>


        {{-- Tombol Tambah --}}
        <div class="d-flex justify-content-end mb-4 wow fadeInUp" data-wow-delay="0.3s">
            <a href="{{ route('posyandu.create') }}" class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
                <i class="fa fa-plus me-2"></i>Tambah Posyandu
            </a>
        </div>

        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.4s" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Kartu Data Posyandu --}}
        <div class="row g-4">
            @forelse ($posyandu as $key => $data)
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.4 + $key * 0.1 }}s">

                    <div class="card h-100 rounded-4 border-0 overflow-hidden shadow-sm"
                        style="transition: transform 0.3s; cursor:pointer;"
                        onmouseover="this.style.transform='translateY(-6px)'"
                        onmouseout="this.style.transform='translateY(0)'">

                        {{-- Header Biru --}}
                        <div class="text-center bg-primary text-white p-3 rounded-top">
                            <div class="d-flex justify-content-center align-items-center mb-2">
                                <i class="fas fa-clinic-medical fa-3x text-white"></i>
                            </div>
                            <h6 class="fw-bold mb-1 text-white">{{ $data->nama }}</h6>
                        </div>

                        {{-- Body --}}
                        <div class="card-body text-start ps-3 pe-2 py-2 fs-7">
                            <p class="mb-2 text-dark">
                                <i class="fa-solid fa-location-dot text-primary me-2"></i>
                                <strong>Alamat:</strong> {{ $data->alamat ?? '-' }}
                            </p>
                            <p class="mb-2 text-dark">
                                <i class="fa-solid fa-map text-primary me-2"></i>
                                <strong>RT/RW:</strong> RT {{ $data->rt ?? '-' }} / RW {{ $data->rw ?? '-' }}
                            </p>
                            <p class="mb-2 text-dark">
                                <i class="fa-solid fa-phone text-primary me-2"></i>
                                <strong>Kontak:</strong> {{ $data->kontak ?? '-' }}
                            </p>
                        </div>

                        {{-- Tombol --}}
                        <div class="card-footer bg-transparent border-0 text-center pb-3">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('posyandu.show', $data->posyandu_id) }}" class="btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center gap-1 shadow-sm" style="min-width: 90px; height: 35px;">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('posyandu.edit', $data->posyandu_id) }}" class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center gap-1 shadow-sm" style="min-width: 90px; height: 35px;">
                                    <i class="fa fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('posyandu.destroy', $data->posyandu_id) }}" method="POST" class="d-flex m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center gap-1 shadow-sm" style="min-width: 90px; height: 35px;">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center text-muted wow fadeInUp" data-wow-delay="0.5s">Belum ada data posyandu.</div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $posyandu->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
@endsection
