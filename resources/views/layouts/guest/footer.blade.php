<!-- Footer Start -->
<footer class="footer text-white" style="background-color:#294392;">
    <div class="container-fluid pt-5 pb-4">
        <div class="container">

            <!-- TOP FOOTER -->
            <div class="row g-4">

                <!-- BRAND -->
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/img/logoverti.png') }}"
                            alt="Logo Posyandu" style="height:70px" class="me-3">

                        <h4 class="mb-0 fw-bold text-white">Posyandu IBARA</h4>
                    </div>

                    <p class="small text-white">
                        Platform digital untuk memantau kesehatan ibu, bayi,
                        balita, dan lansia secara mudah dan terintegrasi.
                    </p>

                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="btn btn-sm rounded-circle text-white" style="background:#1877f2;"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm rounded-circle text-white" style="background:#1da1f2;"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-sm rounded-circle text-white" style="background:#e1306c;"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-sm rounded-circle text-white" style="background:#25d366;"><i
                                class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- MENU CEPAT -->
                <!-- MENU CEPAT -->
                <!-- MENU CEPAT -->
                <div class="col-md-6 col-lg-4">
                    <h6 class="fw-bold mb-3 text-white">Menu Cepat</h6>

                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            <i class="fas fa-chevron-right me-2 text-info"></i>
                            <a href="{{ url('/dashboard') }}" class="text-white text-decoration-none">Beranda</a>
                        </li>

                        <li class="mb-2">
                            <i class="fas fa-chevron-right me-2 text-info"></i>
                            <a href="{{ route('profile') }}" class="text-white text-decoration-none">Profil</a>
                        </li>

                        <!-- DATA (CLICK TO TOGGLE) -->
                        <li class="mb-2">
                            <a class="d-flex align-items-center text-white text-decoration-none"
                                data-bs-toggle="collapse" href="#footerData" role="button" aria-expanded="false"
                                aria-controls="footerData">
                                <i class="fas fa-chevron-right me-2 text-info"></i>
                                <span class="fw-semibold">Data</span>
                            </a>

                            <!-- SUB DATA -->
                            <div class="collapse ms-4 mt-2" id="footerData">
                                <ul class="list-unstyled">
                                    <li class="mb-1">
                                        <i class="fas fa-angle-right me-2 text-info"></i>
                                        <a href="{{ route('warga.index') }}" class="text-white text-decoration-none">
                                            Data Warga
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <i class="fas fa-angle-right me-2 text-info"></i>
                                        <a href="{{ route('posyandu.index') }}" class="text-white text-decoration-none">
                                            Data Posyandu
                                        </a>
                                    </li>
                                    <li>
                                        <i class="fas fa-angle-right me-2 text-info"></i>
                                        <a href="{{ route('kader.index') }}" class="text-white text-decoration-none">
                                            Data Kader
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- TENTANG -->
                        <li class="mb-2">
                            <i class="fas fa-chevron-right me-2 text-info"></i>
                            <a href="{{ route('about') }}" class="text-white text-decoration-none">Tentang</a>
                        </li>
                        <li>
                            <i class="fas fa-chevron-right me-2 text-info"></i>
                            <a href="{{ route('kontak') }}" class="text-white text-decoration-none">Kontak</a>
                        </li>
                    </ul>
                </div>



                <!-- INFORMASI -->
                <div class="col-md-6 col-lg-4">
                    <h6 class="fw-bold mb-3 text-white">Informasi</h6>
                    <p class="small text-white">
                        Dapatkan informasi jadwal, layanan kesehatan,
                        dan laporan Posyandu secara real-time.
                    </p>

                    <div class="d-flex align-items-center mt-3 p-3 rounded" style="background:rgba(255,255,255,.12)">
                        <i class="fas fa-phone-alt fa-2x me-3 text-info"></i>
                        <div>
                            <small class="text-white">Hubungi Kami</small>
                            <div class="fw-bold">+62 895 3865 8718 3</div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- BOTTOM INFO -->
            <div class="row text-center mt-5 pt-4 border-top border-light">
                <div class="col-md-4 mb-3">
                    <i class="fas fa-map-marker-alt fa-2x mb-2 text-info"></i>
                    <p class="small mb-0">Jl. Raya Sukamaju No.45<br>Pekanbaru</p>
                </div>
                <div class="col-md-4 mb-3">
                    <i class="fas fa-envelope fa-2x mb-2 text-info"></i>
                    <p class="small mb-0">info@posyandu.digital</p>
                </div>
                <div class="col-md-4 mb-3">
                    <i class="fas fa-phone fa-2x mb-2 text-info"></i>
                    <p class="small mb-0">+62 895 3865 8718 3</p>
                </div>
            </div>

            <!-- COPYRIGHT -->
            <div class="text-center small mt-3 text-white">
                © {{ date('Y') }} Posyandu Digital. All rights reserved.
            </div>

        </div>
    </div>
</footer>
<!-- Footer End -->