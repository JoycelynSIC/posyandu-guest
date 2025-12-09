@extends('layouts.guest.main')

@section('title', 'Detail Posyandu')

@section('content')
    <div class="py-5 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 p-4" style="max-width:700px;width:100%;">
            <div class="text-center mb-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                    style="width:110px;height:110px;background-color:#e3f2fd;color:#0d6efd;">
                    <i class="fas fa-clinic-medical fa-3x"></i>
                </div>
                <h3 class="fw-bold mt-3">{{ $posyandu->nama }}</h3>
                <p class="text-muted">Informasi lengkap mengenai Posyandu</p>
            </div>

            <p><strong>Alamat:</strong> {{ $posyandu->alamat }}</p>
            <p><strong>RT / RW:</strong> {{ $posyandu->rt }} / {{ $posyandu->rw }}</p>
            <p><strong>Kontak:</strong> {{ $posyandu->kontak }}</p>
            <hr>

            <h5>Dokumen / Foto Posyandu</h5>
            @if ($fotos->count() > 0)
                <div class="row g-3">
                    @foreach ($fotos as $foto)
                        <div class="col-md-4 col-6 foto-col">
                            <div class="border rounded p-2 text-center d-flex flex-column align-items-center 
                            justify-content-between h-100 foto-card">

                                <div class="mb-2 foto-preview d-flex align-items-center justify-content-center"
                                    style="min-height:150px;">
                                    @if (Str::endsWith($foto->file_url, ['.jpg', '.jpeg', '.png']))
                                        <img src="{{ asset('storage/' . $foto->file_url) }}" class="img-fluid rounded"
                                            style="max-height:150px; object-fit:cover;">
                                    @else
                                        <i class="fa fa-file fa-3x text-danger"></i>
                                    @endif
                                </div>

                                <p class="small text-truncate mb-2">{{ basename($foto->file_url) }}</p>

                                <a href="{{ asset('storage/' . $foto->file_url) }}" target="_blank"
                                    class="btn btn-sm btn-primary w-100">
                                    Lihat File
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Tidak ada file.</p>
            @endif


            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('posyandu.index') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>

                <a href="{{ route('posyandu.edit', $posyandu->posyandu_id) }}"
                    class="btn btn-outline-primary rounded-pill px-4">
                    <i class="fa fa-pen me-1"></i> Edit
                </a>
            </div>

        </div>
    </div>
@endsection