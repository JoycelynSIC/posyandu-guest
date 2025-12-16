@extends('layouts.guest.main')

@section('title', 'Edit Jadwal')

@section('content')
    <div class="py-5 bg-light d-flex justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width:450px;width:100%;">
            <div class="card-body p-3">

                {{-- Header --}}
                <div class="text-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-2 border-primary"
                        style="width:55px;height:55px;background:#e8f0ff;">
                        <i class="fa fa-calendar-alt text-primary"></i>
                    </div>
                    <h5 class="fw-bold mt-2 text-primary" style="font-size:1.4rem;">Edit Jadwal Posyandu</h5>
                    <p class="text-muted small mb-0">Perbarui data jadwal kegiatan</p>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('jadwal.update', $jadwal->jadwal_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Alert --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.3s"
                            role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- Upload Poster --}}
                    <div class="mb-2">
                        <label class="fw-semibold small">Poster (Opsional)</label>
                        @php
                            $poster = \App\Models\Media::where('ref_table', 'jadwal')
                                ->where('ref_id', $jadwal->jadwal_id)
                                ->latest()
                                ->first();
                        @endphp
                        @if($poster)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $poster->file_url) }}" alt="Poster Saat Ini"
                                    class="img-thumbnail" style="max-width:120px; max-height:120px;">
                            </div>
                        @endif
                        <input type="file" name="poster" class="form-control form-control-sm">
                        <small class="text-muted">Format: jpg, png, max 2MB</small>
                    </div>

                    <div class="mb-2">
                        <label class="fw-semibold small">Posyandu</label>
                        <select name="posyandu_id" class="form-select form-select-sm" required>
                            @foreach($posyandu as $p)
                                <option value="{{ $p->posyandu_id }}" {{ $jadwal->posyandu_id == $p->posyandu_id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="fw-semibold small">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}"
                            class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label class="fw-semibold small">Tema</label>
                        <input type="text" name="tema" value="{{ $jadwal->tema }}" class="form-control form-control-sm"
                            required>
                    </div>

                    <div class="mb-2">
                        <label class="fw-semibold small">Keterangan</label>
                        <textarea name="keterangan" class="form-control form-control-sm"
                            rows="2">{{ $jadwal->keterangan }}</textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('jadwal.index') }}"
                            class="btn btn-outline-dark d-flex align-items-center justify-content-center gap-1 px-3 py-1 shadow-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>

                        <button type="submit"
                            class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-1 px-3 py-1 shadow-sm">
                            <i class="fa fa-save"></i> Perbarui
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection