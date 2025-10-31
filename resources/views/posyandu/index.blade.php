@extends('layouts.main')

@section('title', 'indexposyandu')

@section('content')
    <div class="py-5 bg-light">
    <div class="container wow fadeIn" data-wow-delay="0.1s">
        {{-- Header --}}
        <div class="text-center mb-5 wow fadeInDown" data-wow-delay="0.2s">
            <h1 class="text-primary fw-bold">Data Posyandu</h1>
            <p class="text-muted">Daftar seluruh Posyandu yang terdaftar di sistem.</p>
        </div>

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
                <div class="col-md-4 col-lg-3 wow fadeInUp" data-wow-delay="{{ 0.5 + ($key * 0.15) }}s">
                    <div class="card warga-card text-center border-0 rounded-4 p-3 h-100 shadow-sm"
                        style="background-color: #f9fafb;">
                        <div class="d-flex flex-column align-items-center wow fadeIn" data-wow-delay="{{ 0.55 + ($key * 0.15) }}s">
                            <img src="https://img.icons8.com/color/96/clinic.png" alt="Posyandu Icon"
                                class="rounded-circle mb-3 shadow-sm warga-img" width="80" height="80">

                            <h6 class="fw-bold mb-1 text-dark wow fadeInUp" data-wow-delay="{{ 0.6 + ($key * 0.15) }}s">
                                {{ $data->nama }}
                            </h6>

                            <p class="text-muted small mb-1 wow fadeInUp" data-wow-delay="{{ 0.65 + ($key * 0.15) }}s">
                                {{ $data->alamat }}
                            </p>

                            <p class="text-muted small mb-1 wow fadeInUp" data-wow-delay="{{ 0.7 + ($key * 0.15) }}s">
                                RT {{ $data->rt }} / RW {{ $data->rw }}
                            </p>

                            <p class="text-muted small wow fadeInUp" data-wow-delay="{{ 0.75 + ($key * 0.15) }}s">
                                <i class="fa fa-phone me-1 text-primary"></i> {{ $data->kontak ?? '-' }}
                            </p>
                        </div>

                        {{-- Tombol Edit & Hapus --}}
                        <div class="d-flex justify-content-center mt-2 border-top pt-2 wow fadeInUp" data-wow-delay="{{ 0.8 + ($key * 0.15) }}s">
                            <a href="{{ route('posyandu.edit', $data->posyandu_id) }}"
                                class="btn btn-sm btn-warning me-2 rounded-circle shadow-sm"
                                style="width:35px;height:35px;display:flex;align-items:center;justify-content:center;">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form action="{{ route('posyandu.destroy', $data->posyandu_id) }}" method="POST" class="d-inline">
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
                <div class="text-center text-muted wow fadeInUp" data-wow-delay="0.5s">
                    Belum ada data posyandu.
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
