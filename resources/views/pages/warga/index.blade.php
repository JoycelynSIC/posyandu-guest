@extends('layouts.main')

@section('title', 'indexwarga')

@section('content')
    <div class="py-5 bg-light d-flex justify-content-center">
        <div class="container">

            {{-- Judul --}}
            <div class="text-center mb-4 wow fadeInDown" data-wow-delay="0.2s">
                <h1 class="text-primary fw-bold">Data Warga</h1>
                <p class="text-muted">Daftar seluruh Warga yang terdaftar di sistem.</p>
            </div>

            {{-- Tombol Tambah --}}
            <div class="d-flex justify-content-end mb-4 wow fadeInUp" data-wow-delay="0.3s">
                <a href="{{ route('warga.create') }}" class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
                    <i class="fa fa-plus me-2"></i>Tambah Warga
                </a>
            </div>

            {{-- Pesan Error --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.4s">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Pesan Sukses --}}
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
                        <div class="card warga-card-clean border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                            {{-- Header --}}
                            <div class="text-center bg-primary text-white p-4 rounded-top">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($data->nama) }}&background=0D6EFD&color=fff&rounded=true"
                                    alt="{{ $data->nama }}"
                                    class="rounded-circle mb-3 border border-3 border-light shadow-sm" width="100"
                                    height="100">

                                <h5 class="fw-bold mb-1 text-white">{{ $data->nama }}</h5>
                                <small class="text-white">NIK: {{ $data->no_ktp ?? '-' }}</small>
                            </div>

                            {{-- Body --}}
                            <div class="card-body text-start px-4 py-3">
                                {{-- Gender dinamis --}}
                                <p class="mb-2 fs-6 text-dark">
                                    @if ($data->jenis_kelamin === 'Laki-laki')
                                        <i class="fa-solid fa-mars text-primary me-2"></i>
                                    @elseif ($data->jenis_kelamin === 'Perempuan')
                                        <i class="fa-solid fa-venus text-danger me-2"></i>
                                    @else
                                        <i class="fa-solid fa-genderless text-secondary me-2"></i>
                                    @endif
                                    <strong>Gender:</strong> {{ $data->jenis_kelamin ?? '-' }}
                                </p>

                                <p class="mb-2 fs-6 text-dark">
                                    <i class="fa-solid fa-praying-hands text-primary me-2"></i>
                                    <strong>Agama:</strong> {{ $data->agama ?? '-' }}
                                </p>

                                <p class="mb-2 fs-6 text-dark">
                                    <i class="fa-solid fa-briefcase text-primary me-2"></i>
                                    <strong>Pekerjaan:</strong> {{ $data->pekerjaan ?? '-' }}
                                </p>

                                <p class="mb-0 fs-6 text-dark">
                                    <i class="fa-solid fa-phone text-primary me-2"></i>
                                    <strong>Telepon:</strong> {{ $data->telp ?? '-' }}
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

        </div>
    </div>
@endsection
