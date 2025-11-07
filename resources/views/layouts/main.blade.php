<head>
    @include('layouts.head')
</head>

<body>
    {{-- Header & Footer disembunyikan hanya di halaman login dan register --}}
    @if (!Request::is('login') && !Request::is('register'))
        @include('layouts.header')
    @endif

    <main class="container-fluid p-0">
        @yield('content')
    </main>

    {{-- Footer --}}
    @if (!Request::is('login') && !Request::is('register'))
        @include('layouts.footer')
    @endif

    <script>
        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("btn-close")) {
                const alert = e.target.closest(".alert");
                if (alert) alert.remove();
            }
        });
    </script>
    @include('layouts.js')
</body>
