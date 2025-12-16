@extends('layouts.guest.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center fw-bold shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">

        <!-- Slide 1 -->
        <div class="header-carousel-item bg-primary">
            <div class="carousel-caption">
                <div class="container py-lg-5">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-7 animated fadeInLeft">
                            <div class="text-sm-center text-md-start">
                                <h4 class="text-white text-uppercase fw-bold mb-3">
                                    Selamat Datang di Posyandu IBARA
                                </h4>

                                <h1 class="display-4 fw-bold text-white mb-4">
                                    Ibu Sehat, Balita Kuat, Keluarga Sejahtera
                                </h1>

                                <p class="mb-5 fs-6 text-light">
                                    Posyandu IBARA (Ibu Balita Sejahtera) adalah sistem layanan kesehatan berbasis
                                    masyarakat yang berfokus pada pemantauan dan pencatatan kesehatan ibu dan balita
                                    secara terintegrasi. Melalui pelayanan yang rapi, cepat, dan akurat, IBARA hadir
                                    untuk mendukung tumbuh kembang anak yang optimal serta mencegah stunting sejak dini.
                                </p>

                                <div class="d-flex justify-content-center justify-content-md-start gap-3 flex-shrink-0">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5" a href="{{ route('about') }}">
                                        Tentang Kami
                                    </a>
                                    <a class="btn btn-outline-light rounded-pill py-3 px-4 px-md-5" a
                                        href="{{ route('kontak') }}">
                                        Hubungi Kami
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 animated fadeInRight text-center">
                            <img src="{{ asset('assets/img/about-1.png') }}" class="img-fluid rounded-4" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="header-carousel-item bg-primary">
            <div class="carousel-caption">
                <div class="container py-lg-5">
                    <div class="row g-5 align-items-center flex-row-reverse">
                        <div class="col-lg-7 animated fadeInRight text-center text-md-end">
                            <h4 class="text-white text-uppercase fw-bold mb-3">Posyandu IBARA</h4>

                            <h1 class="display-4 fw-bold text-white mb-4">
                                Tumbuh Sehat Dimulai dari Perhatian Sejak Dini
                            </h1>

                            <p class="mb-5 fs-6 text-light">
                                Posyandu IBARA menjadi ruang pelayanan dan pendampingan kesehatan
                                bagi ibu dan balita untuk memastikan pertumbuhan yang optimal
                                melalui pemantauan rutin dan data yang tertata.
                            </p>

                            <div class="d-flex justify-content-center justify-content-md-end gap-3 flex-shrink-0">
                                <div class="d-flex justify-content-center justify-content-md-start gap-3 flex-shrink-0">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5" a href="{{ route('about') }}">
                                        Tentang Kami
                                    </a>
                                    <a class="btn btn-outline-light rounded-pill py-3 px-4 px-md-5" a
                                        href="{{ route('kontak') }}">
                                        Hubungi Kami
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 animated fadeInLeft text-center">
                            <img src="{{ asset('assets/img/about-1.png') }}" class="img-fluid rounded-4" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Carousel End -->

    <!-- Informasi Posyandu -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h5 class="text-primary fw-bold text-uppercase mb-3 opacity-0 translate-y-40" data-animate>Informasi
                    Posyandu</h5>
                <h2 class="fw-bold mb-4 opacity-0 translate-y-40" data-animate>Layanan dan Edukasi Posyandu</h2>
               <p class="mb-0 text-muted">
    Posyandu IBARA berperan sebagai pusat pemantauan kesehatan ibu dan balita
    dengan layanan terjadwal, pencatatan yang tertib, serta dukungan
    untuk tumbuh kembang anak yang optimal.
</p>

            </div>

            <div class="row g-4 justify-content-center">
                <!-- Card 1 -->
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item bg-white rounded-4 shadow-sm text-center d-flex flex-column h-100"
                        style="border-radius: 20px; overflow: hidden;">
                        <div class="service-icon p-4 text-primary mx-auto" style="width: fit-content;">
                            <i class="fas fa-baby fa-3x"></i>
                        </div>
                        <div class="service-content p-4 d-flex flex-column flex-grow-1">
                            <a href="#" class="d-inline-block h4 mb-3 text-decoration-none text-dark">Pelayanan Balita</a>
                            <p class="mb-4 text-muted flex-grow-1">Pemantauan tumbuh kembang, imunisasi, dan penyuluhan gizi
                                untuk mendukung generasi sehat dan cerdas.</p>
                            <div class="mt-auto">
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="service-item bg-white rounded-4 shadow-sm text-center d-flex flex-column h-100"
                        style="border-radius: 20px; overflow: hidden;">
                        <div class="service-icon p-4 text-primary mx-auto" style="width: fit-content;">
                            <i class="fas fa-female fa-3x"></i>
                        </div>
                        <div class="service-content p-4 d-flex flex-column flex-grow-1">
                            <a href="#" class="d-inline-block h4 mb-3 text-decoration-none text-dark">Kesehatan Ibu</a>
                            <p class="mb-4 text-muted flex-grow-1">Pemeriksaan kehamilan, konsultasi gizi, dan pendampingan
                                bagi ibu hamil dan menyusui untuk menjaga kesehatan optimal.</p>
                            <div class="mt-auto">
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="service-item bg-white rounded-4 shadow-sm text-center d-flex flex-column h-100"
                        style="border-radius: 20px; overflow: hidden;">
                        <div class="service-icon p-4 text-primary mx-auto" style="width: fit-content;">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="service-content p-4 d-flex flex-column flex-grow-1">
                            <a href="#" class="d-inline-block h4 mb-3 text-decoration-none text-dark">Edukasi Masyarakat</a>
                            <p class="mb-4 text-muted flex-grow-1">Kegiatan penyuluhan tentang pola hidup bersih, gizi
                                seimbang, dan pencegahan stunting di lingkungan masyarakat.</p>
                            <div class="mt-auto">
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Info Posyandu Section End -->

    <!-- Capaian Kami -->
    <section class="py-5 bg-light feature">
        <div class="container text-center">
            <h5 class="text-primary fw-bold text-uppercase mb-3 wow fadeInDown" data-wow-delay="0.2s">Capaian Kami</h5>
            <h2 class="fw-bold mb-4 wow fadeInDown" data-wow-delay="0.4s">Prestasi Posyandu IBARA</h2>

            <p class="mb-4 wow fadeInUp" data-wow-delay="0.4s">
                Memantau kesehatan ibu dan anak melalui layanan rutin, edukasi, dan kegiatan masyarakat yang berdampak
                positif.
            </p>

            <div class="row g-4 justify-content-center">
                <!-- Item 1 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="feature-item text-center p-4 shadow-sm">
                        <div class="feature-icon mb-4 mx-auto">
                            <i class="fas fa-baby fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">120</h4>
                        <p class="mb-0">Balita Terdaftar</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="feature-item text-center p-4 shadow-sm">
                        <div class="feature-icon mb-4 mx-auto">
                            <i class="fas fa-female fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">45</h4>
                        <p class="mb-0">Ibu Hamil Terpantau</p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="feature-item text-center p-4 shadow-sm">
                        <div class="feature-icon mb-4 mx-auto">
                            <i class="fas fa-user-nurse fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">100</h4>
                        <p class="mb-0">Kader Aktif</p>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="feature-item text-center p-4 shadow-sm">
                        <div class="feature-icon mb-4 mx-auto">
                            <i class="fas fa-heartbeat fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">3</h4>
                        <p class="mb-0">Program Layanan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Pelayanan -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h5 class="text-primary fw-bold text-uppercase mb-3 wow fadeInDown" data-wow-delay="0.2s">Jadwal Pelayanan</h5>
            <h2 class="fw-bold mb-5 wow fadeInUp" data-wow-delay="0.4s">Datang dan Ikuti Kegiatan Posyandu</h2>

            <div class="row justify-content-center g-4">
                <!-- Senin -->
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="p-4 bg-white shadow-sm rounded-4 h-100 jadwal-item"
                        style="border-radius: 20px; overflow: hidden;">
                        <div class="mb-3 text-primary">
                            <i class="fas fa-baby fa-2x"></i>
                        </div>
                        <h5 class="fw-semibold mb-2">Senin</h5>
                        <p class="mb-1 text-muted">Pelayanan Balita & Imunisasi</p>
                        <p class="fw-bold text-primary"><i class="far fa-clock me-1"></i> 08.00 - 11.00 WIB</p>
                    </div>
                </div>

                <!-- Rabu -->
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="p-4 bg-white shadow-sm rounded-4 h-100 jadwal-item"
                        style="border-radius: 20px; overflow: hidden;">
                        <div class="mb-3 text-primary">
                            <i class="fas fa-female fa-2x"></i>
                        </div>
                        <h5 class="fw-semibold mb-2">Rabu</h5>
                        <p class="mb-1 text-muted">Pemeriksaan Ibu Hamil</p>
                        <p class="fw-bold text-primary"><i class="far fa-clock me-1"></i> 09.00 - 12.00 WIB</p>
                    </div>
                </div>

                <!-- Jumat -->
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="p-4 bg-white shadow-sm rounded-4 h-100 jadwal-item"
                        style="border-radius: 20px; overflow: hidden;">
                        <div class="mb-3 text-primary">
                            <i class="fas fa-user-md fa-2x"></i>
                        </div>
                        <h5 class="fw-semibold mb-2">Jumat</h5>
                        <p class="mb-1 text-muted">Kesehatan Lansia & Penyuluhan</p>
                        <p class="fw-bold text-primary"><i class="far fa-clock me-1"></i> 08.00 - 10.30 WIB</p>
                    </div>
                </div>

                <!-- Developer Profile Start -->
                <div class="container-fluid team py-5">
                    <div class="container">

                        <!-- CARD UTAMA -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-4 mx-auto wow fadeInUp" data-wow-delay="0.2s"
                            style="max-width: 900px;">

                            <div class="row align-items-center justify-content-center g-4">

                                <!-- FOTO PROFIL -->
                                <div class="col-md-4 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="team-item mx-auto" style="max-width: 220px;">

                                        <div class="team-img">
                                            <img src="assets/img/pp1.jpg" class="img-fluid w-100" alt="Developer">

                                            <div class="team-icon">
                                                <a class="btn btn-primary btn-sm-square rounded-circle"
                                                    href="https://www.instagram.com/jyc.lva" target="_blank">
                                                    <i class="fab fa-instagram"></i>
                                                </a>

                                                <a class="btn btn-primary btn-sm-square rounded-circle"
                                                    href="https://www.linkedin.com/in/joycelyn-d-172720316" target="_blank">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>

                                                <a class="btn btn-primary btn-sm-square rounded-circle"
                                                    href="https://wa.me/62895386587183" target="_blank">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>

                                                <!-- GitHub -->
                                                <a class="btn btn-dark btn-sm-square rounded-circle"
                                                    href="https://github.com/JoycelynSIC" target="_blank">
                                                    <i class="fab fa-github"></i>
                                                </a>
                                            </div>
                                        </div>


                                        <div class="team-title text-center mt-3">
                                            <h6 class="mb-1 fw-bold text-dark">
                                                <i class="fas fa-user me-1 text-primary"></i>
                                                Joycelyn Dhealiva
                                            </h6>

                                            <p class="mb-0 small fw-bold text-dark">
                                                <i class="fas fa-id-card me-1 text-primary"></i>
                                                NIM : 2457301073
                                            </p>

                                            <p class="mb-0 small fw-bold text-dark">
                                                <i class="fas fa-graduation-cap me-1 text-primary"></i>
                                                Sistem Informasi
                                            </p>
                                        </div>


                                    </div>
                                </div>

                                <!-- PROFIL DEVELOPER -->
                                <div class="col-md-8 col-lg-7 wow fadeInUp" data-wow-delay="0.4s">

                                    <!-- Badge -->
                                    <div class="mb-2">
                                        <span class="badge bg-primary bg-opacity-10 text-white px-3 py-2 rounded-pill">
                                            Developer
                                        </span>
                                    </div>

                                    <h3 class="fw-bold mb-2">
                                        Profil Pengembang
                                    </h3>

                                    <!-- Judul Narasi -->
                                    <div class="mb-3 profile-tagline">
                                        <h6 class="fw-semibold text-dark mb-1">
                                            Menghubungkan Teknologi dan Pelayanan Kesehatan
                                        </h6>
                                    </div>

                                    <hr class="my-3">
                                    <!-- Deskripsi -->
                                    <p class="text-muted fst-italic mb-3">
                                        “Saya memiliki ketertarikan dalam pengembangan sistem informasi yang dapat
                                        membantu meningkatkan kualitas pelayanan masyarakat melalui solusi digital
                                        yang informatif, responsif, dan mudah diakses.”
                                    </p>

                                    <hr class="my-3">
                                </div>

                            </div>
                        </div>
                        <!-- END CARD -->

                    </div>
                </div>


    </section>
@endsection