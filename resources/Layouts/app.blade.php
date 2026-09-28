<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AdminSena')</title>

    {{-- Reutiliza los estilos y dependencias compartidos con el proyecto API. --}}
    @include('Includes.dependencias')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* El cliente corre bajo un subdirectorio; sus imágenes estáticas se sirven desde el API. */
        .sena-logo { background-image: url('http://api.adminsena.test/storage/images/Logo%20Sena.png'); }
        .carousel-image-1 { background-image: url('http://api.adminsena.test/storage/images/apren1.jpg'); }
        .carousel-image-2 { background-image: url('http://api.adminsena.test/storage/images/apren2.jpg'); }
        .carousel-image-3 { background-image: url('http://api.adminsena.test/storage/images/aprendi3.jpg'); }
        .carousel-image-4 { background-image: url('http://api.adminsena.test/storage/images/aprendi4.jpg'); }
        .carousel-image-5 { background-image: url('http://api.adminsena.test/storage/images/aprendi5.jpeg'); }
    </style>
</head>
<body>
    {{-- Navegación del cliente limitada a páginas que ya se pueden visualizar. --}}
    <header class="site-header">
        <div class="gov-bar">
            <div class="container d-flex align-items-center">
                <span class="gov-mark" aria-hidden="true">&#10022;</span>
                <span>sena.edu.co</span>
            </div>
        </div>
        <nav class="navbar navbar-light bg-white py-0" aria-label="Navegación principal">
            <div class="container main-nav">
                <a class="navbar-brand sena-brand" href="{{ url('/') }}">
                    <span class="sena-logo" role="img" aria-label="Logo SENA"></span>
                    <span class="sena-word">AdminSena</span>
                </a>
                <a class="nav-link" href="{{ url('/computers') }}">Computadores</a>
                <a class="nav-link" id="login-link" href="{{ route('login') }}">Iniciar sesión</a>
                <button class="nav-link" id="logout-button" type="button" hidden>Cerrar sesión</button>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- Mantiene los recursos de presentación compartidos por ambas páginas. --}}
    @include('Includes.footer')
    @include('Includes.dependenciasbody')
    {{-- Inserta los scripts de interacción de login y Computers. --}}
    @stack('scripts')
    <script>
        // La autenticación Basic solo se conserva en esta pestaña y nunca en una ruta del cliente.
        const adminApiAuth = sessionStorage.getItem('adminsena_basic_auth');
        const loginLink = document.getElementById('login-link');
        const logoutButton = document.getElementById('logout-button');

        loginLink.hidden = Boolean(adminApiAuth);
        logoutButton.hidden = !adminApiAuth;
        logoutButton.addEventListener('click', () => {
            sessionStorage.removeItem('adminsena_basic_auth');
            window.location.assign(@json(url('/')));
        });
    </script>
</body>
</html>