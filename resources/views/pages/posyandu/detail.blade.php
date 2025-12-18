@extends('layouts.guest.main')

@section('title', 'Detail Posyandu')

@section('content')
    <div class="py-4 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 p-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width:600px;width:100%;">
            
            <div class="text-center mb-3 wow fadeInDown" data-wow-delay="0.1s">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                    style="width:90px;height:90px;background-color:#e3f2fd;color:#0d6efd;">
                    <i class="fas fa-clinic-medical fa-2x"></i>
                </div>
                <h4 class="fw-bold mt-2">{{ $posyandu->nama }}</h4>
                <p class="text-muted mb-1">Informasi lengkap Posyandu</p>
            </div>

            <div class="wow fadeInUp" data-wow-delay="0.2s">
                <p class="mb-1"><strong>Alamat:</strong> {{ $posyandu->alamat }}</p>
                <p class="mb-1"><strong>RT / RW:</strong> {{ $posyandu->rt }} / {{ $posyandu->rw }}</p>
                <p class="mb-1"><strong>Kontak:</strong> {{ $posyandu->kontak }}</p>
                <hr class="my-2">
            </div>

            {{-- FOTO POSYANDU --}}
            <h6 class="mb-2 wow fadeInUp" data-wow-delay="0.3s">Dokumen / Foto Posyandu</h6>

           <div class="row g-2 wow fadeInUp" data-wow-delay="0.3s">
    @if ($fotos->count() > 0)
        @foreach ($fotos as $index => $foto)
            <div class="col-6 col-md-4">
                <div class="border rounded p-1 text-center d-flex flex-column align-items-center justify-content-between"
                    style="height:180px;">

                    <div class="d-flex align-items-center justify-content-center mb-1"
                        style="height:100px;width:100%;overflow:hidden;">
                        @if (\Illuminate\Support\Str::endsWith($foto->file_name, ['.jpg', '.jpeg', '.png']))
                            <img src="{{ asset('storage/' . $foto->file_name) }}" class="img-fluid rounded"
                                style="height:100%;object-fit:cover;">
                        @else
                            <i class="fa fa-file fa-2x text-danger"></i>
                        @endif
                    </div>

                    <p class="small text-truncate mb-1">{{ basename($foto->file_name) }}</p>

                    <!-- Tombol Lihat Preview -->
                    <button type="button" class="btn btn-outline-primary btn-sm w-100 py-1" data-bs-toggle="modal" data-bs-target="#previewModal{{ $index }}">
                        <i class="fa fa-eye me-1"></i> Lihat File
                    </button>

                    <!-- Modal Preview -->
                    <div class="modal fade" id="previewModal{{ $index }}" tabindex="-1" aria-labelledby="previewModalLabel{{ $index }}" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="previewModalLabel{{ $index }}">{{ basename($foto->file_name) }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-center">
                            @if (\Illuminate\Support\Str::endsWith($foto->file_name, ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset('storage/' . $foto->file_name) }}" class="img-fluid" style="max-height:80vh; object-fit:contain;">
                            @else
                                <iframe src="{{ asset('storage/' . $foto->file_name) }}" class="w-100" style="height:80vh;"></iframe>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>

                </div>
            </div>
        @endforeach
    @else
        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="d-flex flex-column align-items-center justify-content-center" style="height:180px;">
                <img src="{{ asset('assets/img/placeholderimg.png') }}" class="img-fluid opacity-75"
                    style="max-height:100px; object-fit:contain;">
                <p class="small text-muted mt-1 mb-0">Belum ada foto/dokumen</p>
            </div>
        </div>
    @endif
</div>


            <div class="mt-3 d-flex justify-content-between wow fadeInUp" data-wow-delay="0.4s">
                <a href="{{ route('posyandu.index') }}" class="btn btn-primary rounded-pill px-3 py-1">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>

                <a href="{{ route('posyandu.edit', $posyandu->posyandu_id) }}"
                    class="btn btn-outline-primary rounded-pill px-3 py-1">
                    <i class="fa fa-pen me-1"></i> Edit
                </a>
            </div>

        </div>
    </div>
@endsection
