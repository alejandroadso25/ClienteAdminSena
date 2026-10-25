<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AdminSena')</title>

    @php include resource_path('Includes/dependence.navbar.blade.php'); @endphp
    
    @php include resource_path('Includes/dependence.footer.blade.php'); @endphp
</head>

<body>
    @php
        // Esta lista compartida mantiene iguales los enlaces de navegación pública y administrativa.
        
        $tableLinks = [
            ['route' => 'apprentices.index', 'label' => 'Aprendices'],
            ['route' => 'areas.index', 'label' => 'Áreas'],
            ['route' => 'computers.index', 'label' => 'Computadores'],
            ['route' => 'courses.index', 'label' => 'Cursos'],
            ['route' => 'course-teachers.index', 'label' => 'Asignaciones'],
            ['route' => 'teachers.index', 'label' => 'Instructores'],
            ['route' => 'training-centers.index', 'label' => 'Centros de formación'],
        ];

        $isAdminSection = request()->routeIs(
            'computers.*',
            'apprentices.*',
            'areas.*',
            'courses.*',
            'course-teachers.*',
            'teachers.*',
            'training-centers.*'
        );
    @endphp

    {{-- La navegación cambia según se visite una tabla administrativa o una página pública. --}}
    @if ($isAdminSection)
        <div class="admin-shell">
            <header class="admin-navbar">
                <a class="admin-brand" href="{{ route('home') }}" aria-label="Ir al inicio de AdminSena">
                    <span class="admin-brand-mark sena-logo" role="img" aria-label="Logo SENA"></span>
                </a>
                <a class="admin-home-link" href="{{ route('home') }}">Ir al inicio</a>

                <nav class="nav-links" aria-label="Navegación de registros">
                    <div class="nav-dropdown">
                        <details>
                            <summary>Tablas</summary>
                            <div class="nav-submenu">
                                @foreach ($tableLinks as $tableLink)
                                    <a href="{{ route($tableLink['route']) }}">{{ $tableLink['label'] }}</a>
                                @endforeach
                            </div>
                        </details>
                    </div>
                </nav>
            </header>

            <div class="content-shell">
                <aside class="sidebar" aria-label="Menú de registros">
                    <h2>Menú</h2>
                    <ul>
                        @foreach ($tableLinks as $tableLink)
                            <li>
                                <a
                                    class="{{ request()->routeIs(str_replace('.index', '.*', $tableLink['route'])) ? 'active' : '' }}"
                                    href="{{ route($tableLink['route']) }}">
                                    {{ $tableLink['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

                <main class="main-content">
                    @yield('content')
                </main>
            </div>
        </div>
    @else
        <header>
            <div class="bg-success text-white py-2">
                <div class="container d-flex align-items-center gap-2">
                    <span aria-hidden="true">✦</span>
                    <span>sena.edu.co</span>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg bg-body-tertiary" aria-label="Navegación principal">
                <div class="container">
                    <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">AdminSena</a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#publicNavigation"
                        aria-controls="publicNavigation"
                        aria-expanded="false"
                        aria-label="Abrir menú">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="publicNavigation">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">Tablas</a>
                                <ul class="dropdown-menu">
                                    
                                @foreach ($tableLinks as $tableLink)
                                        <li>
                                            <a class="dropdown-item" href="{{ route($tableLink['route']) }}">
                                                {{ $tableLink['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <a href="{{ url('/login') }}" class="btn btn-outline-success">Inicio / Registro</a>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>
    @endif

    {{-- El footer queda reservado para páginas públicas; se omite en los módulos administrativos. --}}
    @unless ($isAdminSection)
        <footer class="site-footer">
            <div class="container footer-grid">
                <div>
                    <h2>AdminSena</h2>
                    <p>Gestión académica para centros de formación.</p>
                    <a href="#contacto">Contáctanos</a>
                </div>
                <div>
                    <h3>Redes sociales</h3>
                    <div class="footer-socials" aria-label="Redes sociales del SENA">
                        <a href="https://www.facebook.com/SENAComunica" target="_blank" rel="noopener noreferrer" aria-label="Facebook">f</a>
                        <a href="https://x.com/SENAComunica" target="_blank" rel="noopener noreferrer" aria-label="X">X</a>
                        <a href="https://www.instagram.com/senacomunica/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">◎</a>
                        <a href="https://www.youtube.com/user/SENATV" target="_blank" rel="noopener noreferrer" aria-label="YouTube">▶</a>
                    </div>
                </div>
                <div id="contacto">
                    <h3>Contáctanos</h3>
                    <p>Bogotá: (601) 343 0111</p>
                    <p>Línea nacional: 01 8000 910 270</p>
                </div>
            </div>
            <div class="container footer-bottom">© {{ date('Y') }} AdminSena · Servicio Nacional de Aprendizaje</div>
        </footer>
    @endunless

    @php include resource_path('Includes/dependence.body.blade.php'); 
    
    @endphp
    
    @stack('scripts')
</body>
</html>