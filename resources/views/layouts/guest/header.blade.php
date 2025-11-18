<!-- Navbar Start (TIDAK DIUBAH STRUKTURNYA) -->
<div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">

            <a href="dashboard" class="navbar-brand p-0">
                <h1 class="text-primary mb-0">
                    <i class="fab fa-slack me-2"></i> Posyandu
                </h1>
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">

                <div class="navbar-nav mx-0 mx-lg-auto">

                    <a href="{{ url('/dashboard') }}"
                        class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home text-primary me-1"></i> Home
                    </a>

                    <!-- 🔵 MENU PROFIL (BARU) -->
                    <a href="{{ route('profile') }}"
                       class="nav-item nav-link {{ request()->is('profile') ? 'active' : '' }}">
                        <i class="fas fa-user-circle text-primary me-1"></i> Profil
                    </a>
                    
                    <!-- Dropdown Data -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle
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
                        </div>
                    </div>

                    <a href="{{ route('about') }}"
                        class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">
                        <i class="fas fa-info-circle text-primary me-1"></i> Tentang
                    </a>

                    <a href="{{ route('kontak') }}"
                        class="nav-item nav-link {{ request()->is('kontak') ? 'active' : '' }}">
                        <i class="fas fa-phone-alt text-primary me-1"></i> Kontak
                    </a>


                    <!-- 🔴 MENU LOGOUT (BARU) -->
                    @auth
                        <a href="#"
                           class="nav-item nav-link text-danger"
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
 