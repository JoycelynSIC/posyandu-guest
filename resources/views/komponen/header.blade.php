<!-- resources/views/layouts/header.blade.php -->

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
                        <a href="mailto:example@gmail.com" class="text-muted small">
                            <i class="fas fa-envelope text-primary me-2"></i>example@gmail.com
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-flex justify-content-end">
                    <div class="d-flex border-end border-primary pe-3">
                        <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="btn p-0 text-primary me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="dropdown ms-3">
                        <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown">
                            <small><i class="fas fa-globe-europe text-primary me-2"></i> Indonesia</small>
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
                    <a href="{{ url('/dashboard') }}" class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('warga.index') }}" class="nav-item nav-link {{ request()->is('warga*') ? 'active' : '' }}">Data Warga</a>
                    <a href="{{ route('posyandu.index') }}" class="nav-item nav-link {{ request()->is('posyandu*') ? 'active' : '' }}">Data Posyandu</a>
                    <a href="/about" class="nav-item nav-link">Tentang Kami</a>
                    <a href="/service" class="nav-item nav-link">Layanan</a>
                    <a href="/blog" class="nav-item nav-link">Blog</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle">Halaman</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="feature.html" class="dropdown-item">Fitur</a>
                            <a href="team.html" class="dropdown-item">Team Kami</a>
                            <a href="testimonial.html" class="dropdown-item">Testimoni</a>
                            <a href="FAQ.html" class="dropdown-item">Pertanyaan Lainnya</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div>

                    <a href="/contact" class="nav-item nav-link">Kontak</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
