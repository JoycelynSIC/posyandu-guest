@extends('layouts.guest.main')

@section('title', 'Detail Catatan Imunisasi')

@section('content')
    <div class="py-5 bg-light d-flex justify-content-center px-2 px-md-0">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" style="max-width:700px; width:100%;">
            <div class="card-body p-4">

                {{-- Header --}}
                <div class="text-center mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                        style="width:60px; height:60px; background:#e8f0ff;">
                        <i class="fas fa-syringe text-primary"></i>
                    </div>
                    <h4 class="fw-bold mt-2 text-primary">Detail Catatan Imunisasi</h4>
                    <p class="text-muted small mb-0">Informasi lengkap catatan imunisasi warga</p>
                </div>

                {{-- Informasi Catatan --}}
                <div class="d-flex flex-column flex-md-row gap-4 align-items-center">

                    {{-- File / Dokumen --}}
                    @php
                        $fileUrl = $data->file_name
                            ? asset('storage/imunisasi/' . $data->file_name)
                            : asset('assets/img/placeholderimg.png'); // placeholder kalau tidak ada file
                    @endphp

                    <div class="text-start flex-shrink-0 ms-md-3" style="max-width:200px;">
                        <p class="small fw-bold mb-2">Dokumen:</p>

                        <img src="{{ $fileUrl }}" alt="File Imunisasi" class="img-fluid rounded shadow-sm"
                            style="max-height:250px; width:100%; object-fit:cover;">

                        @if($data->file_name)
                            <button type="button" class="btn btn-outline-primary btn-sm mt-2 w-100" data-bs-toggle="modal"
                                data-bs-target="#previewModalFile">
                                <i class="fa fa-eye"></i> Lihat
                            </button>

                            <div class="modal fade" id="previewModalFile" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $data->file_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            @if(\Illuminate\Support\Str::endsWith($data->file_name, ['.jpg', '.jpeg', '.png']))
                                                <img src="{{ $fileUrl }}" class="img-fluid"
                                                    style="max-height:80vh; object-fit:contain;">
                                            @else
                                                <iframe src="{{ $fileUrl }}" class="w-100" style="height:80vh;"></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Informasi --}}
                    <div class="flex-grow-1">
                        <div class="mb-2 d-flex gap-2 align-items-start">
                            <i class="fa fa-user text-primary mt-1"></i>
                            <div>
                                <strong>Warga:</strong>
                                <p class="mb-0">{{ $data->warga->nama }}</p>
                            </div>
                        </div>

                        <div class="mb-2 d-flex gap-2 align-items-start">
                            <i class="fa fa-vial text-primary mt-1"></i>
                            <div>
                                <strong>Jenis Vaksin:</strong>
                                <p class="mb-0">{{ $data->jenis_vaksin }}</p>
                            </div>
                        </div>

                        @if($data->lokasi)
                            <div class="mb-2 d-flex gap-2 align-items-start">
                                <i class="fa fa-map-marker-alt text-primary mt-1"></i>
                                <div>
                                    <strong>Lokasi:</strong>
                                    <p class="mb-0">{{ $data->lokasi }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="mb-2 d-flex gap-2 align-items-start">
                            <i class="fa fa-user-md text-primary mt-1"></i>
                            <div>
                                <strong>Petugas Nakes:</strong>
                                <p class="mb-0">{{ $data->nakes ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-2 d-flex gap-2 align-items-start">
                            <i class="fa fa-calendar text-primary mt-1"></i>
                            <div>
                                <strong>Tanggal:</strong>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Tombol --}}
                <div class="d-flex gap-2 mt-4 flex-wrap">
                    <!-- Kembali -->
                    <a href="{{ url()->previous() }}"
                        class="btn btn-outline-dark d-flex align-items-center justify-content-center gap-1 flex-grow-1 px-3 py-1">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>

                    <!-- Edit & Hapus (Admin Only) -->
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('imunisasi.edit', $data->id) }}"
                                class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-1 flex-grow-1 px-3 py-1">
                                <i class="fa fa-pen"></i> Edit
                            </a>

                            <form action="{{ route('imunisasi.destroy', $data->id) }}" method="POST" class="flex-grow-1 m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus catatan ini?')"
                                    class="btn btn-outline-danger d-flex align-items-center justify-content-center gap-1 w-100 px-3 py-1">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    @endauth

                </div>

            </div>
        </div>
    </div>
@endsection