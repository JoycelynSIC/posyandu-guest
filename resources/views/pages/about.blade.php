@extends('layouts.guest.main')

@section('content')
    <!-- Tentang Kami Section -->
    <section class="feature py-5 bg-light">
        <div class="container d-flex align-items-center justify-content-center flex-wrap">
            <!-- Gambar -->
            <div class="image-about text-center p-3 wow fadeInLeft" data-wow-delay="0.2s">
                <img src="{{ asset('assets/img/about.png') }}" alt="Tentang Kami" style="max-width: 350px; height: auto;">
            </div>

            <!-- Teks -->
            <div class="text-about ms-md-5 mt-4 mt-md-0 wow fadeInRight" data-wow-delay="0.4s" style="max-width: 550px;">
                <h6 class="text-primary fw-bold">TENTANG KAMI</h6>
                <h2 class="fw-bold mb-3">Posyandu IBARA</h2>
                <p>
                    Posyandu IBARA (Ibu Balita Sejahtera) merupakan layanan kesehatan berbasis masyarakat
                    yang berfokus pada pemantauan kesehatan ibu dan balita secara berkala untuk mendukung
                    tumbuh kembang anak yang optimal sejak dini.
                </p>
                <p>
                    Melalui peran aktif kader dan partisipasi warga, Posyandu IBARA menghadirkan layanan
                    kesehatan yang terarah, terdata, dan berkelanjutan demi mewujudkan keluarga yang lebih
                    sehat dan sejahtera.
                </p>

            </div>
        </div>
    </section>

    <!-- Nilai & Misi Section -->
    <section class="feature py-5 bg-light">
        <div class="container text-center">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
                <h5 class="text-primary fw-bold text-uppercase mb-2">Nilai Kami</h5>
                <h2 class="fw-bold mb-5">Melayani dengan Hati dan Profesionalitas</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="feature-item p-4 shadow-sm h-100 bg-white rounded-4">
                        <div class="feature-icon mb-3 text-primary">
                            <i class="fas fa-heart fa-2x"></i>
                        </div>
                        <h4 class="fw-semibold mb-3 text-dark">Kepedulian</h4>
                        <p class="text-muted mb-0">
                            Kami selalu hadir dengan rasa empati tinggi dalam setiap pelayanan bagi masyarakat.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="feature-item p-4 shadow-sm h-100 bg-white rounded-4">
                        <div class="feature-icon mb-3 text-primary">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h4 class="fw-semibold mb-3 text-dark">Kolaborasi</h4>
                        <p class="text-muted mb-0">
                            Kami bekerja sama dengan masyarakat dan pemerintah untuk menciptakan lingkungan sehat.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="feature-item p-4 shadow-sm h-100 bg-white rounded-4">
                        <div class="feature-icon mb-3 text-primary">
                            <i class="fas fa-stethoscope fa-2x"></i>
                        </div>
                        <h4 class="fw-semibold mb-3 text-dark">Profesional</h4>
                        <p class="text-muted mb-0">
                            Kami menjunjung tinggi mutu dan etika dalam setiap kegiatan pelayanan kesehatan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection