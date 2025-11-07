@extends('layouts.guest.main')

@section('content')
    <!-- Hubungi Kami Section -->
    <section class="feature py-5 bg-light">
        <div class="container text-center">
            <h5 class="text-primary fw-bold text-uppercase mb-3 wow fadeInUp" data-wow-delay="0.1s">Hubungi Kami</h5>
            <h2 class="fw-bold mb-5 wow fadeInUp" data-wow-delay="0.2s">Kami Siap Membantu Anda</h2>

            {{-- 3 Card Kontak --}}
            <div class="row justify-content-center g-4">
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="contact-card p-4 shadow-sm bg-white h-100 transition-hover rounded-3"
                        style="border-radius: 12px;">
                        <i class="fas fa-phone-alt fa-3x text-primary mb-3"></i>
                        <h5 class="fw-semibold mb-2">Telepon</h5>
                        <p class="text-muted mb-0">+62 895 3865 8718 3</p>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="contact-card p-4 shadow-sm bg-white h-100 transition-hover rounded-3"
                        style="border-radius: 12px;">
                        <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                        <h5 class="fw-semibold mb-2">Email</h5>
                        <p class="text-muted mb-0">posyandubinadesa@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="contact-card p-4 shadow-sm bg-white h-100 transition-hover rounded-3"
                        style="border-radius: 12px;">
                        <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                        <h5 class="fw-semibold mb-2">Alamat</h5>
                        <p class="text-muted mb-0">Jl. Raya Sukamaju No.45, Pekanbaru</p>
                    </div>
                </div>
            </div>

            {{-- Tombol WhatsApp --}}
            <section class="py-5 bg-light">
                <div class="container text-center">
                    <h2 class="fw-bold mb-3 wow fadeInDown" data-wow-delay="0.2s">Ada Pertanyaan Seputar Posyandu?</h2>
                    <p class="mb-4 wow fadeInUp" data-wow-delay="0.4s">
                        Kami siap membantu! Hubungi kami melalui WhatsApp untuk informasi lebih lanjut.
                    </p>
                    <a href="https://wa.me/62895386587183" target="_blank"
                        class="btn btn-light rounded-pill px-4 py-2 shadow fw-semibold fs-5 wow zoomIn"
                        data-wow-delay="0.6s">
                        <i class="fab fa-whatsapp me-2"></i> Chat Sekarang
                    </a>
                </div>
            </section>
        </div>
    </section>
@endsection