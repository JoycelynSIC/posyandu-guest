@extends('layouts.main')

@section('title', 'indexwarga')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="text-primary fw-bold">Data Warga</h1>
        </div>

        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('warga.create') }}" class="btn btn-primary px-4 py-2">
                <i class="fa fa-plus me-2"></i>Tambah Warga
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse ($warga as $key => $data)
                <div class="col-md-4 col-lg-3 fade-up-card" style="animation-delay: {{ $key * 0.15 }}s">
                    <div class="card warga-card text-center border-0 rounded-4 p-3 h-100 shadow-sm" style="background-color: #f9fafb;">
    <div class="d-flex flex-column align-items-center">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($data->nama) }}&background=random&rounded=true"
            alt="{{ $data->nama }}" class="rounded-circle mb-3 shadow-sm warga-img" width="80" height="80">

        <h6 class="fw-bold mb-1 text-dark">{{ $data->nama }}</h6>
        <p class="text-muted mb-1 small">{{ $data->pekerjaan ?? '-' }}</p>

        <p class="text-muted small mb-2 d-flex align-items-center justify-content-center gap-1">
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

        <!-- Garis pembatas -->
        <hr class="my-2 w-75">

        <!-- Nomor KTP sebagai badge -->
        <div class="mb-3">
            <span class="badge bg-light text-dark px-3 py-2 shadow-sm border small">
                {{ $data->telp ?? '-' }}
            </span>
        </div>
    </div>

    <!-- Tombol Edit & Hapus -->
    <div class="d-flex justify-content-center border-top pt-2">
        <a href="{{ route('warga.edit', $data->warga_id) }}" class="btn btn-sm btn-warning me-2 rounded-circle shadow-sm"
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
                <div class="text-center text-muted">Belum ada data warga.</div>
            @endforelse
        </div>
    </div>
@endsection
