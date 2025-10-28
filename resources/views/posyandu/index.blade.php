@extends('layouts.main')

@section('title', 'indexposyandu')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="text-primary fw-bold">Data Posyandu</h1>
            <p class="text-muted">Daftar seluruh Posyandu yang terdaftar di sistem.</p>
        </div>

        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('posyandu.create') }}" class="btn btn-primary px-4 py-2">
                <i class="fa fa-plus me-2"></i>Tambah Posyandu
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse ($posyandu as $key => $data)
                <div class="col-md-4 col-lg-3 fade-up-card" style="animation-delay: {{ $key * 0.15 }}s">
                    <div class="card warga-card text-center border-0 rounded-4 p-3 h-100 shadow-sm"
                        style="background-color: #f9fafb;">
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://img.icons8.com/color/96/clinic.png" alt="Posyandu Icon"
                                class="rounded-circle mb-3 shadow-sm warga-img" width="80" height="80">

                            <h6 class="fw-bold mb-1 text-dark">{{ $data->nama }}</h6>
                            <p class="text-muted small mb-1">
                                {{ $data->alamat }}
                            </p>
                            <p class="text-muted small mb-1">
                                RT {{ $data->rt }} / RW {{ $data->rw }}
                            </p>
                            <p class="text-muted small">
                                <i class="fa fa-phone me-1 text-primary"></i> {{ $data->kontak ?? '-' }}
                            </p>
                        </div>

                        <div class="d-flex justify-content-center mt-2">
                            <a href="{{ route('posyandu.edit', $data->posyandu_id) }}" class="btn btn-sm btn-warning me-2">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form action="{{ route('posyandu.destroy', $data->posyandu_id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">Belum ada data posyandu.</div>
            @endforelse
        </div>
    </div>
@endsection

