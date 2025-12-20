@extends('layouts.guest.main')

@section('title', 'Catatan Imunisasi')

@section('content')
    <div class="py-5 bg-light">
        <div class="container">

            {{-- Header --}}
            <div class="text-center mb-5 wow fadeInDown" data-wow-delay="0.1s">
                <h1 class="fw-bold text-primary mb-2">Catatan Imunisasi</h1>
                <p class="text-muted fs-5">Daftar catatan imunisasi warga.</p>
            </div>


            {{-- Filter & Search --}}
            <form method="GET" class="row g-3 mb-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-6">
                    <label class="form-label fw-bold mb-1">Temukan</label>
                    <input type="text" name="search" class="form-control shadow-sm" placeholder="Cari nama warga / vaksin"
                        value="{{ request('search') }}">
                </div>

                <div class="col-12 d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary shadow-sm rounded-pill flex-fill py-2 px-3">Go</button>
                    @if (request('search') || request('warga_id'))
                        <a href="{{ route('imunisasi.index') }}"
                            class="btn btn-outline-primary shadow-sm rounded-pill flex-fill py-2 px-3 d-flex align-items-center justify-content-center">
                            Clear
                        </a>
                    @endif
                </div>
            </form>

            {{-- Tombol Tambah --}}
            <div class="text-end mb-4 wow fadeInUp" data-wow-delay="0.15s">
                <a href="{{ route('imunisasi.create') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                    <i class="fa fa-plus me-2"></i>Tambah Catatan
                </a>
            </div>

            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Cards Catatan Imunisasi --}}
            <div class="row g-4">
                @forelse($data as $key => $d)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.2 + $key * 0.1 }}s">
                        <div class="card h-100 rounded-4 border-0 overflow-hidden shadow-sm"
                            style="transition: transform 0.3s; cursor: pointer;"
                            onmouseover="this.style.transform='translateY(-6px)';"
                            onmouseout="this.style.transform='translateY(0)';">

                            {{-- Header --}}
                            <div class="card-header bg-primary text-white text-center fw-bold fs-6">
                                <i class="fa fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') }}
                            </div>

                            {{-- Body --}}
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3 text-primary">
                                    <i class="fa fa-user me-2"></i> {{ $d->warga->nama ?? '-' }}
                                </h6>

                                <p class="mb-2">
                                    <i class="fa-solid fa-syringe me-2 text-primary"></i>
                                    <strong>Vaksin:</strong> {{ $d->jenis_vaksin }}
                                </p>
                                @if($d->lokasi)
                                    <p class="mb-2">
                                        <i class="fa-solid fa-location-dot me-2 text-primary"></i>
                                        <strong>Lokasi:</strong> {{ $d->lokasi }}
                                    </p>
                                @endif
                                <p class="mb-2">
                                    <i class="fa-solid fa-user-nurse me-2 text-primary"></i>
                                    <strong>Petugas Nakes:</strong> {{ $d->nakes ?? '-' }}
                                </p>

                            </div>

                            {{-- Footer --}}
                            <div class="card-footer text-center bg-primary border-0 pt-2 pb-2">
                                <a href="{{ route('imunisasi.show', $d->imunisasi_id) }}"
                                    class="btn btn-outline-light btn-sm shadow-sm">
                                    <i class="fa fa-eye me-1"></i> Detail
                                </a>

                                <a href="{{ route('imunisasi.edit', $d->imunisasi_id) }}"
                                    class="btn btn-outline-light btn-sm shadow-sm">
                                    <i class="fa fa-pen me-1"></i> Edit
                                </a>

                                <form action="{{ route('imunisasi.destroy', $d) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
            class="btn btn-outline-light btn-sm shadow-sm">
        <i class="fa fa-trash me-1"></i> Hapus
    </button>
</form>

                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted wow fadeInUp" data-wow-delay="0.25s">
                        Belum ada catatan imunisasi.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4 wow fadeInUp" data-wow-delay="0.3s">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
@endsection