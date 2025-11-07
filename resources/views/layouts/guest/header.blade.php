<!-- Topbar Start -->
<div class="container-fluid topbar px-0 px-lg-4 bg-light py-2 d-none d-lg-block">
    <div class="container">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                <div class="d-flex flex-wrap">
                    <div class="border-end border-primary pe-3">
                        <a href="#" class="text-muted small">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>Bina Desa
                        </a>
                    </div>

                    <div class="ps-3">
                        @if (Auth::check())
                            <a href="{{ route('profile') }}" class="text-muted small">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                {{ Auth::user()->email }}
                            </a>
                        @else
                            <a href="mailto:example@gmail.com" class="text-muted small">
                                <i class="fas fa-envelope text-primary me-2"></i>Silakan Login
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-flex justify-content-end align-items-center">
                    <div class="d-flex align-items-center border-end border-primary pe-3">
                        @guest
                            <small>
                                <a href="{{ route('login') }}" class="btn btn-link nav-item nav-link p-0 m-0">
                                    <i class="fas fa-sign-in-alt text-primary me-1"></i> Login
                                </a>
                            </small>
                        @else
                            <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                                @csrf
                                <button type="submit" class="btn btn-link nav-item nav-link text-danger p-0 m-0">
                                    <i class="fas fa-sign-out-alt text-primary me-1"></i> Logout
                                </button>
                            </form>
                        @endguest
                    </div>

                    <div class="dropdown ms-3 d-flex align-items-center">
                        <a href="#" class="dropdown-toggle text-dark d-flex align-items-center"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-globe-europe text-primary me-2"></i> Indonesia
                        </a>
                        <div class="dropdown-menu rounded">
                            <a href="#" class="dropdown-item">Indonesia</a>
                            <a href="#" class="dropdown-item">English</a>
                            <a href="#" class="dropdown-item">Bangla</a>
                            <a href="#" class="dropdown-item">French</a>
                            <a href="#" class="dropdown-item">Spanish</a>
                            <a href="#" class="dropdown-item">Arabic</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="#" class="navbar-brand p-0">
                <h1 class="text-primary mb-0"><i class="fab fa-slack me-2"></i> Posyandu</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-0 mx-lg-auto">
                    <a href="{{ url('/dashboard') }}"
                        class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home text-primary me-1"></i> Home
                    </a>

                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle {{ request()->is('warga*') || request()->is('posyandu*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-database text-primary me-1"></i> Data
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('warga.index') }}" class="dropdown-item">
                                <i class="fas fa-users text-primary me-2"></i> Data Warga
                            </a>
                            <a href="{{ route('posyandu.index') }}" class="dropdown-item">
                                <i class="fas fa-clinic-medical text-primary me-2"></i> Data Posyandu
                            </a>
                        </div>
                    </div>
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">
                                <i class="fas fa-info-circle text-primary me-1"></i> Tentang
                            </a>
                        </li>

                        <a class="nav-item nav-link" href="{{ route('kontak') }}">
                            <i class="fas fa-phone-alt text-primary me-1"></i> Kontak
                        </a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->