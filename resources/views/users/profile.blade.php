@extends('layouts.main')

@section('title', 'Profil Saya')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="text-primary fw-bold">Profil Saya</h1>
            <p class="text-muted">Informasi akun yang kamu gunakan saat ini</p>
        </div>

        <div class="d-flex justify-content-center">
            <div class="card border-0 rounded-4 shadow-sm p-4" 
                 style="max-width: 480px; background-color: #f9fafb;">
                 
                <div class="text-center mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&rounded=true"
                        alt="{{ $user->name }}" 
                        class="rounded-circle shadow-sm mb-3" 
                        width="90" height="90">

                    <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-0">{{ $user->email }}</p>
                </div>

                <hr class="my-3">

                <div class="px-3 small">
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Nama Lengkap</span>
                        <span class="fw-semibold text-dark">{{ $user->name }}</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Email</span>
                        <span class="fw-semibold text-dark">{{ $user->email }}</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Tanggal Dibuat</span>
                        <span class="fw-semibold text-dark">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Terakhir Diperbarui</span>
                        <span class="fw-semibold text-dark">{{ $user->updated_at->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="text-center mt-4 d-flex justify-content-center gap-2 flex-wrap">
                    <a href="{{ route('users.edit', $user->id) }}" 
                       class="btn btn-sm btn-warning me-2">
                        <i class="fa fa-pen me-1"></i>Edit
                    </a>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus akun ini? Akunmu akan dihapus permanen.')"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm px-3">
                            <i class="fa fa-trash me-1"></i>Hapus
                        </button>
                    </form>

                    <a href="{{ url()->previous() }}" 
                       class="btn btn-primary btn-sm px-3">
                        <i class="fa fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
