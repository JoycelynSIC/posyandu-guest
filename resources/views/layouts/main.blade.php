<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('komponen.head')
</head>

<body>
    @include('komponen.header')

    <main class="container-fluid p-0">
        @yield('content')
    </main>

    @include('komponen.footer')

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