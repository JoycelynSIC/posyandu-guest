@extends('layouts.guest.main')

@section('title', 'Detail Jadwal')

@section('content')
<div class="py-5 bg-light d-flex justify-content-center px-2 px-md-0">
    <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" style="max-width:700px; width:100%;">
        <div class="card-body p-4">

            {{-- Header --}}
            <div class="text-center mb-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                     style="width:60px; height:60px; background:#e8f0ff;">
                    <i class="fa fa-calendar-alt text-primary"></i>
                </div>
                <h4 class="fw-bold mt-2 text-primary">Detail Jadwal Posyandu</h4>
                <p class="text-muted small mb-0">Informasi lengkap jadwal kegiatan</p>
            </div>

            {{-- Poster + Informasi Jadwal --}}
            <div class="d-flex flex-column flex-md-row gap-4 align-items-center">

                {{-- Poster --}}
                @if($jadwal->media->count() > 0)
                    @php $poster = $jadwal->media->first(); @endphp
                    <div class="text-start flex-shrink-0 ms-md-3" style="max-width:200px;">
                        <p class="small fw-bold mb-2">Poster :</p>
                        <img src="{{ asset('storage/' . $poster->file_url) }}" 
                             alt="Poster"
                             class="img-fluid rounded shadow-sm" 
                             style="max-height:250px; width:100%; object-fit:cover;">

                        {{-- Tombol Lihat --}}
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2 w-100"
                                data-bs-toggle="modal" data-bs-target="#previewModalPoster">
                            <i class="fa fa-eye"></i> Lihat
                        </button>

                        {{-- Modal Preview --}}
                        <div class="modal fade" id="previewModalPoster" tabindex="-1"
                             aria-labelledby="previewModalPosterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="previewModalPosterLabel">
                                            {{ basename($poster->file_url) }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        @if (\Illuminate\Support\Str::endsWith($poster->file_url, ['.jpg', '.jpeg', '.png']))
                                            <img src="{{ asset('storage/' . $poster->file_url) }}" class="img-fluid"
                                                 style="max-height:80vh; object-fit:contain;">
                                        @else
                                            <iframe src="{{ asset('storage/' . $poster->file_url) }}" class="w-100"
                                                    style="height:80vh;"></iframe>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Informasi Jadwal --}}
                <div class="flex-grow-1">
                    <div class="mb-2 d-flex gap-2 align-items-start">
                        <i class="fa fa-hospital text-primary mt-1"></i>
                        <div>
                            <strong>Posyandu:</strong>
                            <p class="mb-0">{{ $jadwal->posyandu->nama }}</p>
                        </div>
                    </div>

                    <div class="mb-2 d-flex gap-2 align-items-start">
                        <i class="fa fa-calendar text-primary mt-1"></i>
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

                <!-- Kembali -->
                <a href="{{ url()->previous() }}"
                   class="btn btn-outline-dark d-flex align-items-center justify-content-center gap-1 flex-grow-1 px-3 py-1">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

                <!-- Edit & Hapus (Admin Only) -->
                @auth
                    @if(auth()->user()->is_admin)
                        <!-- Edit -->
                        <a href="{{ route('jadwal.edit', $jadwal->jadwal_id) }}"
                           class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-1 flex-grow-1 px-3 py-1">
                            <i class="fa fa-pen"></i> Edit
                        </a>

                        <!-- Hapus -->
                        <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" method="POST" class="flex-grow-1 m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
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
