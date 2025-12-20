@extends('layouts.guest.main')

@section('title', 'Detail Jadwal')

@section('content')
<div class="py-3 bg-light d-flex justify-content-center px-2 px-md-0">
    <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" style="max-width:700px; width:100%; background-color:#f9fafb;">
        <div class="card-body p-3">

            {{-- Header --}}
            <div class="text-center mb-3 wow fadeInDown" data-wow-delay="0.1s">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                     style="width:70px; height:70px; background-color:#e3f2fd; color:#0d6efd;">
                    <i class="fa fa-calendar-alt fa-lg"></i>
                </div>
                <h5 class="fw-bold mt-2 mb-1 text-primary">Detail Jadwal Posyandu</h5>
                <p class="text-muted mb-1" style="font-size:0.8rem;">Informasi lengkap jadwal kegiatan</p>
            </div>

            {{-- Poster + Info Jadwal --}}
            <div class="d-flex flex-column flex-md-row gap-4 align-items-start">

                {{-- Poster --}}
                @php
                    $poster = $jadwal->media->first();
                    $posterUrl = $poster ? asset('storage/' . $poster->file_name) : asset('assets/img/placeholderimg.png');
                @endphp
                <div class="text-start flex-shrink-0" style="max-width:200px;">
                    <p class="small fw-bold mb-2">Poster :</p>
                    <img src="{{ $posterUrl }}" alt="Poster" class="img-fluid rounded shadow-sm"
                         style="max-height:250px; width:100%; object-fit:cover;">
                    @if($poster)
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2 w-100" data-bs-toggle="modal"
                                data-bs-target="#previewModalPoster">
                            <i class="fa fa-eye"></i> Lihat
                        </button>

                        <div class="modal fade" id="previewModalPoster" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ basename($poster->file_name) }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        @if(\Illuminate\Support\Str::endsWith($poster->file_name, ['.jpg', '.jpeg', '.png']))
                                            <img src="{{ asset('storage/' . $poster->file_name) }}" class="img-fluid"
                                                 style="max-height:80vh; object-fit:contain;">
                                        @else
                                            <iframe src="{{ asset('storage/' . $poster->file_name) }}" class="w-100"
                                                    style="height:80vh;"></iframe>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Info Jadwal --}}
                <div class="flex-grow-1">
                    <div class="mb-2 d-flex gap-2 align-items-start">
                        <i class="fa fa-clinic-medical text-primary mt-1"></i>
                        <div>
                            <strong>Posyandu:</strong>
                            <p class="mb-0">{{ $jadwal->posyandu->nama }}</p>
                        </div>
                    </div>

                    <div class="mb-2 d-flex gap-2 align-items-start">
                        <i class="fa fa-calendar-alt text-primary mt-1"></i>
                        <div>
                            <strong>Tanggal:</strong>
                            <p class="mb-0">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="mb-2 d-flex gap-2 align-items-start">
                        <i class="fa fa-bullhorn text-primary mt-1"></i>
                        <div>
                            <strong>Tema:</strong>
                            <p class="mb-0">{{ $jadwal->tema }}</p>
                        </div>
                    </div>

                    <div class="mb-2 d-flex gap-2 align-items-start">
                        <i class="fa fa-info-circle text-primary mt-1"></i>
                        <div>
                            <strong>Keterangan:</strong>
                            <p class="mb-0">{{ $jadwal->keterangan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="d-flex gap-2 mt-4 flex-wrap">
                <a href="{{ url()->previous() }}"
                   class="btn btn-outline-dark rounded-pill d-flex align-items-center justify-content-center gap-1 flex-grow-1 px-3 py-1">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('jadwal.edit', $jadwal->jadwal_id) }}"
                           class="btn btn-outline-primary rounded-pill d-flex align-items-center justify-content-center gap-1 flex-grow-1 px-3 py-1">
                            <i class="fa fa-pen"></i> Edit
                        </a>

                        <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" method="POST" class="flex-grow-1 m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                    class="btn btn-outline-danger rounded-pill d-flex align-items-center justify-content-center gap-1 w-100 px-3 py-1">
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
