@extends('layouts.guest.main')

@section('title', 'Manajemen Akun')

@section('content')
<div class="py-4 bg-light">
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-4 wow fadeInDown">
            <h2 class="fw-bold text-primary mb-1">Manajemen Akun</h2>
            <p class="text-muted small mb-0">
                Kelola akun dan peran pengguna
            </p>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2 small">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Cards --}}
        <div class="row g-3">
            @foreach($users as $key => $user)
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.1 + $key * 0.04 }}s">
                    <div class="card h-100 border-0 shadow-sm rounded-4">

                        {{-- Header --}}
                        <div class="card-header py-2 text-center fw-semibold text-white
                            {{ $user->role === 'admin' ? 'bg-success' : 'bg-primary' }}">
                            <i class="fa fa-user-shield me-1"></i> Akun Pengguna
                        </div>

                        {{-- Body --}}
                        <div class="card-body text-center p-3">

                            {{-- Foto --}}
                            @php
                                $foto = $user->profile_image && file_exists(public_path('storage/' . $user->profile_image))
                                    ? asset('storage/' . $user->profile_image)
                                    : asset('assets/img/placeholder.png');
                            @endphp

                            <img src="{{ $foto }}"
                                class="rounded-circle border border-2
                                {{ $user->role === 'admin' ? 'border-success' : 'border-primary' }}
                                shadow-sm mb-2"
                                style="width:65px;height:65px;object-fit:cover;">

                            {{-- Detail Akun --}}
                            <div class="text-start small px-2 mt-2">

                                <p class="mb-1">
                                    <i class="fa fa-id-badge text-primary me-2"></i>
                                    <strong>Nama</strong> : {{ $user->name }}
                                </p>

                                <p class="mb-1">
                                    <i class="fa fa-envelope text-primary me-2"></i>
                                    <strong>Email</strong> : {{ $user->email }}
                                </p>

                                <p class="mb-2">
                                    <i class="fa fa-user-tag text-primary me-2"></i>
                                    <strong>Role</strong> :
                                    <span class="badge rounded-pill
                                        {{ $user->role === 'admin' ? 'bg-success' : 'bg-primary' }}">
                                        {{ strtoupper($user->role) }}
                                    </span>
                                </p>

                            </div>

                            {{-- Role Form --}}
                            <form action="{{ route('users.admin.updateRole', $user->id) }}"
                                  method="POST"
                                  class="d-flex align-items-center justify-content-center gap-1 mt-2">
                                @csrf
                                @method('PUT')

                                <select name="role"
                                    class="form-select form-select-sm text-center rounded-pill w-75">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                        User
                                    </option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>

                                <button type="submit"
                                    onclick="return confirm('Ubah role user ini?')"
                                    class="btn btn-sm btn-outline-primary rounded-pill px-2">
                                    Simpan
                                </button>
                            </form>

                            {{-- Note --}}
                            @if(auth()->id() === $user->id)
                                <small class="text-muted d-block mt-1" style="font-size:11px">
                                    * Mengubah role sendiri akan logout otomatis
                                </small>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="d-flex justify-content-center mt-4 wow fadeInUp">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>
@endsection
