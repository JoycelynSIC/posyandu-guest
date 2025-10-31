<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Bina Desa')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-light">

    {{-- Header --}}
    @include('komponen.header')

    {{-- Isi Halaman --}}


    {{-- Footer sederhana dulu biar gak error --}}
    <footer class="bg-primary text-white text-center py-3 mt-auto">
        <small>&copy; 2025 Bina Desa. All rights reserved.</small>
    </footer>

    @include('komponen.js')
</body>

</html>
