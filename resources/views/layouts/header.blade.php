<!-- Topbar Start -->
<div class="container-fluid topbar px-0 px-lg-4 bg-light py-2 d-none d-lg-block">
    <div class="container">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                <div class="d-flex flex-wrap">
                    <div class="border-end border-primary pe-3">
                        <a href="#" class="text-muted small">
                            Bina Desa
                        </a>
                    </div>

                    <div class="ps-3">
                        @if (Auth::check())
                            <a href="{{ route('profile') }}" class="text-muted small">
                                {{ Auth::user()->email }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-muted small">
                                Silakan Login
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
                                    Login
                                </a>
                            </small>
                        @else
                            <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                                @csrf
                                <button type="submit" class="btn btn-link nav-item nav-link text-danger p-0 m-0">
                                    Logout
                                </button>
                            </form>
                        @endguest
                    </div>

                    <div class="dropdown ms-3 d-flex align-items-center">
                        <a href="#" class="dropdown-toggle text-dark d-flex align-items-center" data-bs-toggle="dropdown">
                            Indonesia
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
                <h1 class="text-primary mb-0">Posyandu</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-0 mx-lg-auto">
                    <a href="{{ url('/dashboard') }}"
                       class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        Home
                    </a>

                    <div class="nav-item dropdown">
                        <a href="#"
                           class="nav-link dropdown-toggle {{ request()->is('warga*') || request()->is('posyandu*') ? 'active' : '' }}"
                           data-bs-toggle="dropdown">
                            Data
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('warga.index') }}" class="dropdown-item">
                                Data Warga
                            </a>
                            <a href="{{ route('posyandu.index') }}" class="dropdown-item">
                                Data Posyandu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
