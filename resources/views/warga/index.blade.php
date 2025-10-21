<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
        <title>LifeSure - Life Insurance Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    </head>
<body>
     @include('komponen.header')
        
    <!-- Data Warga Section Start -->
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="text-center text-primary fw-bold mb-4">Data Warga</h1>
        </div>

        <div class="d-flex justify-content-end mb-4 wow fadeIn" data-wow-delay="0.2s">
            <a href="{{ route('warga.create') }}" class="btn btn-primary px-4 py-2">
                <i class="fa fa-plus me-2"></i>Tambah Warga
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show wow fadeIn" data-wow-delay="0.2s">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive wow fadeInUp" data-wow-delay="0.3s">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>No KTP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Pekerjaan</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($warga as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->no_ktp }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->jenis_kelamin }}</td>
                            <td>{{ $data->agama }}</td>
                            <td>{{ $data->pekerjaan }}</td>
                            <td>{{ $data->telp ?? '-' }}</td>
                            <td>{{ $data->email ?? '-' }}</td>
                            <td>
                                <a href="{{ route('warga.edit', $data->warga_id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <form action="{{ route('warga.destroy', $data->warga_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-muted">Belum ada data warga.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Data Warga Section End -->


    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 col-md-12">
                    <h1 class="text-white mb-4"><i class="fab fa-slack me-2"></i>Posyandu</h1>
                    <p class="mb-0">Sistem informasi posyandu yang membantu pengelolaan data warga dan kegiatan kesehatan masyarakat.</p>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright py-3">
            <div class="text-center">
                &copy; 2025 <a class="border-bottom" href="#">LifeSure</a>, All Right Reserved.
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
