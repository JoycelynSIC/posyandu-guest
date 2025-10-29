<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('komponen.head')
</head>

<body>
    {{-- Header & Footer disembunyikan hanya di halaman login dan register --}}
    @if (!Request::is('login') && !Request::is('register'))
        @include('komponen.header')
    @endif

    <main class="container-fluid p-0">
        @yield('content')
    </main>

    @if (!Request::is('login') && !Request::is('register'))
        @include('komponen.footer')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-whatever" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("btn-close")) {
                const alert = e.target.closest(".alert");
                if (alert) alert.remove();
            }
        });
    </script>
</body>

</html>
