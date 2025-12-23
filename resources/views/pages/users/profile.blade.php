@extends('layouts.guest.main')

@section('title', 'Profil Saya')

@section('content')
<div class="py-5 bg-light d-flex justify-content-center">
    <div class="container" style="max-width: 380px; padding: 0 8px;">

        {{-- Judul --}}
        <div class="text-center mb-3 wow fadeInDown" data-wow-delay="0.1s">
            <h4 class="text-primary fw-bold mb-1">Profil Saya</h4>
            <p class="text-muted mb-0 small">Informasi akun yang kamu gunakan</p>
        </div>

        {{-- Alert --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show wow fadeInUp" data-wow-delay="0.2s" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


        
        {{-- Card Profil Compact --}}
        <div class="card border-0 rounded-4 shadow-sm p-3 wow fadeInUp" data-wow-delay="0.2s" style="box-sizing: border-box; width: 100%;">

            {{-- Foto & Nama --}}
            <div class="text-center mb-2">
                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('assets/img/placeholder.png') }}"
                     alt="{{ $user->name }}"
                     class="rounded-circle border border-2 border-primary shadow-sm"
                     style="width: 80px; height: 80px; object-fit: cover;">
                <h5 class="fw-bold text-dark mt-2 mb-0">{{ $user->name }}</h5>
                <p class="text-muted small mb-0"><i class="fa fa-envelope text-primary me-1"></i>{{ $user->email }}</p>
            </div>

            <hr class="my-2">

            {{-- Info Compact --}}
            <div class="small">
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted"><i class="fa fa-id-card me-1 text-primary"></i>Nama</span>
                    <span class="fw-semibold text-dark">{{ $user->name }}</span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted"><i class="fa fa-envelope me-1 text-primary"></i>Email</span>
                    <span class="fw-semibold text-dark">{{ $user->email }}</span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted"><i class="fa fa-calendar-alt me-1 text-primary"></i>Dibuat</span>
                    <span class="fw-semibold text-dark">{{ $user->created_at->format('d M Y') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted"><i class="fa fa-sync-alt me-1 text-primary"></i>Update</span>
                    <span class="fw-semibold text-dark">{{ $user->updated_at->format('d M Y') }}</span>
                </div>
            </div>

            <hr class="my-2">

            {{-- Tombol Compact & Sama Ukuran, Jarak Rata --}}
            <div class="d-flex flex-wrap gap-2 justify-content-between">

                <a href="{{ route('users.edit', $user->id) }}" 
                   class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center flex-fill"
                   style="min-height: 36px;">
                   <i class="fa fa-pen me-1"></i> Edit
                </a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" 
                      onsubmit="return confirm('Yakin hapus akun?')" 
                      class="flex-fill m-0 p-0 d-flex">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-outline-danger btn-sm flex-fill d-flex align-items-center justify-content-center"
                            style="min-height: 36px;">
                        <i class="fa fa-trash me-1"></i> Hapus
                    </button>
                </form>

                <a href="{{ route('dashboard') }}" 
                   class="btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center flex-fill"
                   style="min-height: 36px;">
                   <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>

            </div>

        </div>
    </div>
</div>
@endsection
