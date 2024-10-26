<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Marker+Hatch&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100 bg-light-subtle">
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid mx-2">
            <a class="navbar-brand rubik-marker-hatch-regular mx-3" href="{{ route('home')}}">
                <i class="bi bi-book-half"></i>
                Bookworm
            </a>
            <div class="me-auto">
                <ul class="navbar-nav ms-5">
                    <div class="vr"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <div class="vr"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">Products</a>
                    </li>
                    <div class="vr"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders') }}">Orders</a>
                    </li>
                    <div class="vr"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('publishers') }}">Penerbit</a>
                    </li>
                    <div class="vr"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('genres') }}">Genre</a>
                    </li>
                    <div class="vr"></div>
                </ul>
            </div>
            {{--! atmin --}}
        </div>
    </nav>
        
    <main>
        @yield('content')
    </main>
        
    @yield('scripts')

    <footer class="container-fluid mt-auto" id="footer">
        <p class="mt-2">&copy; 2024 Kesaf Rakhsandiaz</p>
    </footer>
</body>
</html>