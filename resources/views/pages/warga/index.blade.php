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

            {{-- Tabel Data Warga --}}
            <div class="table-responsive wow fadeInUp" data-wow-delay="0.5s">
                <table class="table table-bordered table-striped align-middle shadow-sm">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>No. Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($warga as $key => $data)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($data->nama) }}&background=0D6EFD&color=fff&rounded=true"
                                            alt="{{ $data->nama }}"
                                            class="rounded-circle me-2 border border-2 border-primary shadow-sm"
                                            width="40" height="40">
                                        <span class="fw-semibold">{{ $data->nama }}</span>
                                    </div>
                                </td>
                                <td>{{ $data->no_ktp ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($data->jenis_kelamin === 'Laki-laki')
                                        <i class="fa-solid fa-mars text-primary"></i> Laki-laki
                                    @elseif ($data->jenis_kelamin === 'Perempuan')
                                        <i class="fa-solid fa-venus text-danger"></i> Perempuan
                                    @else
                                        <i class="fa-solid fa-genderless text-secondary"></i> -
                                    @endif
                                </td>
                                <td>{{ $data->agama ?? '-' }}</td>
                                <td>{{ $data->pekerjaan ?? '-' }}</td>
                                <td>{{ $data->telp ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('warga.edit', $data->warga_id) }}"
                                            class="btn btn-sm btn-primary shadow-sm px-3">
                                            <i class="fa fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('warga.destroy', $data->warga_id) }}" method="POST"
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
                                <td colspan="8" class="text-center text-muted">Belum ada data warga.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
