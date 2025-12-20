<!-- Navbar Start (TIDAK DIUBAH STRUKTURNYA) -->
<div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">

            <a href="dashboard" class="navbar-brand p-0">
                <img src="{{ asset('assets/img/logohori.png') }}" alt="Logo" class="navbar-logo" />
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

                    <!-- MENU PROFIL -->
                    @auth
                        <a href="{{ route('profile') }}"
                            class="nav-item nav-link {{ request()->is('profile') ? 'active' : '' }}">
                            <i class="fas fa-user-circle text-primary me-1"></i> Profil
                        </a>
                    @endauth

                    <!-- Dropdown Data -->
                    @auth
                        <div class="nav-item dropdown">
                            <a href="#"
                                class="nav-link dropdown-toggle
                                {{ request()->is('warga*') || request()->is('posyandu*') || request()->is('kader*') ? 'active' : '' }}"
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
                                <a href="{{ route('kader.index') }}" class="dropdown-item">
                                    <i class="fas fa-user-nurse text-primary me-2"></i> Data Kader
                                </a>
                                <a href="{{ route('jadwal.index') }}" class="dropdown-item">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i> Jadwal Posyandu
                                </a>
                                <a href="{{ route('imunisasi.index') }}" class="dropdown-item">
                <i class="fas fa-syringe text-primary me-2"></i> Catatan Imunisasi
            </a>
                            </div>
                        </div>
                    @endauth

                    <a href="{{ route('about') }}"
                        class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">
                        <i class="fas fa-info-circle text-primary me-1"></i> Tentang
                    </a>

                    <a href="{{ route('kontak') }}"
                        class="nav-item nav-link {{ request()->is('kontak') ? 'active' : '' }}">
                        <i class="fas fa-phone-alt text-primary me-1"></i> Kontak
                    </a>

                    <!-- 🔵 TOMBOL MASUK (JIKA BELUM LOGIN) -->
                    @guest
                        <a href="{{ route('login') }}" class="nav-item nav-link fw-semibold text-primary">
                            <i class="fas fa-sign-in-alt me-1"></i> Masuk
                        </a>
                    @endguest

                    <!-- 🔴 LOGOUT (JIKA SUDAH LOGIN) -->
                    @auth
                        <a href="#" class="nav-item nav-link text-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt text-danger me-1"></i> Logout
                        </a>

                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                            @csrf
                        </form>
                    @endauth

                </div>
            </div>

        </nav>
    </div>
</div>
<!-- Navbar End -->