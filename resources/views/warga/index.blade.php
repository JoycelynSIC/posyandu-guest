@extends('layouts.main')

@section('title', 'indexwarga')

@section('content')
    <div class="py-5 bg-light">

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
                    <div class="col-md-4 col-lg-3 wow fadeInUp" data-wow-delay="{{ 0.5 + ($key * 0.15) }}s">
                        <div class="card warga-card text-center border-0 rounded-4 p-3 h-100 shadow-sm"
                            style="background-color: #ffffff;"> {{-- Background putih --}}

                            <div class="d-flex flex-column align-items-center wow fadeIn"
                                data-wow-delay="{{ 0.6 + ($key * 0.15) }}s">

                                <img src="https://ui-avatars.com/api/?name={{ urlencode($data->nama) }}&background=random&rounded=true"
                                    alt="{{ $data->nama }}" class="rounded-circle mb-3 shadow-sm warga-img" width="80"
                                    height="80">

                                <h6 class="fw-bold mb-1 text-dark wow fadeInUp" data-wow-delay="{{ 0.65 + ($key * 0.15) }}s">
                                    {{ $data->nama }}
                                </h6>
                                <p class="text-muted mb-1 small wow fadeInUp" data-wow-delay="{{ 0.7 + ($key * 0.15) }}s">
                                    {{ $data->pekerjaan ?? '-' }}
                                </p>

                                <p class="text-muted small mb-2 d-flex align-items-center justify-content-center gap-1 wow fadeInUp"
                                    data-wow-delay="{{ 0.75 + ($key * 0.15) }}s">
                                    @if ($data->jenis_kelamin === 'Laki-laki')
                                        <i class="fa-solid fa-mars text-primary"></i> Laki-laki
                                    @elseif ($data->jenis_kelamin === 'Perempuan')
                                        <i class="fa-solid fa-venus text-danger"></i> Perempuan
                                    @else
                                        <i class="fa-solid fa-genderless text-secondary"></i> {{ $data->jenis_kelamin ?? '-' }}
                                    @endif
                                    <span class="mx-1">|</span>
                                    {{ $data->agama }}
                                </p>

                                <hr class="my-2 w-75 wow fadeIn" data-wow-delay="{{ 0.8 + ($key * 0.15) }}s">

                                <div class="mb-3 wow fadeInUp" data-wow-delay="{{ 0.85 + ($key * 0.15) }}s">
                                    <span class="badge bg-light text-dark px-3 py-2 shadow-sm border small">
                                        {{ $data->telp ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Tombol Edit & Hapus --}}
                            <div class="d-flex justify-content-center border-top pt-2 wow fadeInUp"
                                data-wow-delay="{{ 0.9 + ($key * 0.15) }}s">
                                <a href="{{ route('warga.edit', $data->warga_id) }}"
                                    class="btn btn-sm btn-warning me-2 rounded-circle shadow-sm"
                                    style="width:35px;height:35px;display:flex;align-items:center;justify-content:center;">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <form action="{{ route('warga.destroy', $data->warga_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')"
                                        class="btn btn-sm btn-danger rounded-circle shadow-sm"
                                        style="width:35px;height:35px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
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