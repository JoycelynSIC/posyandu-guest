@extends('layouts.guest.main')

@section('title', 'indexwarga')

@section('content')
    <div class="py-5 bg-light d-flex justify-content-center">
        <div class="container">

            {{-- Judul --}}
            <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.2s">
                <h1 class="text-primary fw-bold">Data Warga</h1>
                <p class="text-muted">Daftar seluruh Warga yang terdaftar di sistem.</p>
            </div>

            {{-- FILTER + SEARCH --}}
            <form method="GET" action="{{ route('warga.index') }}" class="wow fadeInUp mb-4 mt-3" data-wow-delay="0.25s">
                <div class="row g-3">

                    {{-- Search global (nama, pekerjaan, email, no_ktp, telp) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Search</label>
                        <div class="d-flex gap-2">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                placeholder="Cari nama, pekerjaan, email, no KTP, atau telp...">
                        </div>
                    </div>

                    {{-- Filter per kolom (jenis_kelamin + agama) --}}
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">Semua</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">Agama</label>
                        <select name="agama" class="form-select">
                            <option value="">Semua</option>
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $ag)
                                <option value="{{ $ag }}" {{ request('agama') == $ag ? 'selected' : '' }}>{{ $ag }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary shadow-sm rounded-pill flex-fill py-2 px-3">
                                Go
                            </button>

                            {{-- Tombol Clear muncul kalau search atau filter ada --}}
                            @if(request('search') || request('jenis_kelamin') || request('agama'))
                                <a href="{{ route('warga.index') }}"
                                    class="btn btn-outline-primary shadow-sm rounded-pill flex-fill py-2 px-3 d-flex align-items-center justify-content-center">
                                    Clear
                                </a>
                            @endif

                </div>
            </form>



            {{-- Tombol Tambah --}}
            <div class="wow fadeInUp mb-4 d-flex justify-content-end" data-wow-delay="0.3s">
                <a href="{{ route('warga.create') }}" class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
                    <i class="fa fa-plus me-2"></i>Tambah Warga
                </a>
            </div>

            {{-- Pesan Error / Sukses --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.4s">
                    <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.4s">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Kartu Data Warga --}}
            <div class="row g-4">
                @forelse ($warga as $key => $data)
                    <div class="col-md-4 col-lg-3 wow fadeInUp" data-wow-delay="{{ 0.4 + $key * 0.1 }}s">
                        <div class="card warga-card-clean border-0 shadow-sm rounded-4 h-100 overflow-hidden position-relative">

                            {{-- Nomor Urut --}}
                            <div
                                class="position-absolute top-0 start-0 bg-primary text-white px-3 py-1 rounded-bottom-end small fw-bold">
                                {{ ($warga->currentPage() - 1) * $warga->perPage() + $loop->iteration }}
                            </div>

                            {{-- Header --}}
                            <div class="text-center bg-primary text-white p-4 rounded-top">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($data->nama) }}&background=0D6EFD&color=fff&rounded=true"
                                    alt="{{ $data->nama }}" class="rounded-circle mb-3 border border-3 border-light shadow-sm"
                                    width="100" height="100">
                                <h5 class="fw-bold mb-1 text-white">{{ $data->nama }}</h5>
                                <small class="text-white">NIK: {{ $data->no_ktp ?? '-' }}</small>
                            </div>

                            {{-- Body --}}
                            <div class="card-body text-start px-4 py-3">
                                <p class="mb-2 fs-6 text-dark">
                                    @if ($data->jenis_kelamin === 'Laki-laki')
                                        <i class="fa-solid fa-mars text-primary me-2"></i>
                                    @elseif ($data->jenis_kelamin === 'Perempuan')
                                        <i class="fa-solid fa-venus text-danger me-2"></i>
                                    @else
                                        <i class="fa-solid fa-genderless text-secondary me-2"></i>
                                    @endif
                                    <strong>Gender :</strong> {{ $data->jenis_kelamin ?? '-' }}
                                </p>
                                <p class="mb-2 fs-6 text-dark">
                                    <i class="fa-solid fa-praying-hands text-primary me-2"></i>
                                    <strong>Agama :</strong> {{ $data->agama ?? '-' }}
                                </p>
                                <p class="mb-2 fs-6 text-dark">
                                    <i class="fa-solid fa-briefcase text-primary me-2"></i>
                                    <strong>Pekerjaan :</strong> {{ $data->pekerjaan ?? '-' }}
                                </p>
                                <p class="mb-0 fs-6 text-dark">
                                    <i class="fa-solid fa-phone text-primary me-2"></i>
                                    <strong>No.Telp :</strong> {{ $data->telp ?? '-' }}
                                </p>
                            </div>

                            {{-- Tombol Edit & Hapus --}}
                            <div class="card-footer bg-transparent border-0 text-center pb-4">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <a href="{{ route('warga.edit', $data->warga_id) }}"
                                        class="btn btn-primary btn-sm d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                        style="min-width: 90px; height: 38px;">
                                        <i class="fa fa-pen"></i> <span>Edit</span>
                                    </a>
                                    <form action="{{ route('warga.destroy', $data->warga_id) }}" method="POST"
                                        class="d-flex align-items-center m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')"
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
                    <div class="text-center text-muted wow fadeInUp" data-wow-delay="0.5s">Belum ada data warga.</div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $warga->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
@endsection