@extends('layouts.guest.main')

@section('title', '403 - Akses Ditolak')

@section('content')
<!-- 403 Start -->
<div class="container-fluid bg-light py-5">
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">

                <i class="fas fa-frown display-1 text-primary mb-4"
                   style="width: 80px; height: 80px;"></i>

                <h1 class="display-1">403</h1>
                <h1 class="mb-4">Akses Ditolak</h1>

                <p class="mb-4">
                    Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                    Silakan kembali ke halaman utama atau hubungi administrator.
                </p>

                <a class="btn btn-primary rounded-pill py-3 px-5"
                   href="{{ route('dashboard') }}">
                    Kembali ke Dashboard
                </a>

            </div>
        </div>
    </div>
</div>
<!-- 403 End -->
@endsection
