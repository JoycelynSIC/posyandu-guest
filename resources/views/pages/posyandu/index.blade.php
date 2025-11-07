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

            {{-- Tabel Data Posyandu --}}
            <div class="table-responsive wow fadeInUp" data-wow-delay="0.5s">
                <table class="table table-bordered table-striped align-middle shadow-sm">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Posyandu</th>
                            <th>Alamat</th>
                            <th>RT/RW</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posyandu as $key => $data)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="fw-semibold">
                                    <i class="fas fa-clinic-medical text-primary me-2"></i>
                                    {{ $data->nama }}
                                </td>
                                <td>{{ $data->alamat ?? '-' }}</td>
                                <td class="text-center">RT {{ $data->rt ?? '-' }} / RW {{ $data->rw ?? '-' }}</td>
                                <td>{{ $data->kontak ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('posyandu.edit', $data->posyandu_id) }}"
                                            class="btn btn-sm btn-primary shadow-sm px-3">
                                            <i class="fa fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('posyandu.destroy', $data->posyandu_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm px-3">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data posyandu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
