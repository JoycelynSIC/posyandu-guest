<head>
    @include('layouts.guest.head')
</head>

<body>
    {{-- Header & Footer disembunyikan hanya di halaman login dan register --}}
    @if (!Request::is('login') && !Request::is('register'))
        @include('layouts.guest.header')
    @endif

    <main class="container-fluid p-0">
        @yield('content')
    </main>
    
    {{-- Floating WhatsApp Button --}}
    @if (!Request::is('login') && !Request::is('register'))
        <div class="wa-container">
            <a href="https://wa.me/62895386587183" target="_blank" class="wa-float">
                <i class="fab fa-whatsapp"></i>
                <span class="wa-text">Chat Sekarang</span>
            </a>
        </div>
    @endif
    {{-- Footer --}}
    @if (!Request::is('login') && !Request::is('register'))
        @include('layouts.guest.footer')
    @endif

    <script>
        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("btn-close")) {
                const alert = e.target.closest(".alert");
                if (alert) alert.remove();
            }
        });
    </script>
    @include('layouts.guest.js')
</body>