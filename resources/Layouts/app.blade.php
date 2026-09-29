<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AdminSena')</title>

    @include('Includes.dependencias')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .sena-logo {
            background-image: url('http://api.adminsena.test/storage/images/Logo%20Sena.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    @php
        // Una sola fuente mantiene sincronizados el menú desplegable y la barra lateral.
        $tableLinks = [
            ['route' => 'apprentices.index', 'label' => 'Aprendices'],
            ['route' => 'areas.index', 'label' => 'Áreas'],
            ['route' => 'computers.index', 'label' => 'Computadores'],
            ['route' => 'courses.index', 'label' => 'Cursos'],
            ['route' => 'course-teachers.index', 'label' => 'Asignaciones'],
            ['route' => 'teachers.index', 'label' => 'Instructores'],
            ['route' => 'training-centers.index', 'label' => 'Centros de formación'],
        ];
    @endphp

    @if (request()->routeIs('computers.index', 'apprentices.index', 'areas.index', 'courses.index', 'course-teachers.index', 'teachers.index', 'training-centers.index'))
    <div class="admin-shell">
        <header class="admin-navbar">
            <a class="admin-brand" href="{{ route('home') }}" aria-label="Ir al inicio de AdminSena">
                <span class="admin-brand-mark sena-logo" role="img" aria-label="Logo SENA"></span>
            </a>
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
                            <a class="{{ request()->routeIs($tableLink['route']) ? 'active' : '' }}" href="{{ route($tableLink['route']) }}">
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
    <header class="site-header">
        <div class="gov-bar">
            <div class="container gov-inner">
                <span class="gov-mark" aria-hidden="true">✦</span>
                <span>sena.edu.co</span>
            </div>
        </div>

        <div class="container main-nav-wrapper">
            <nav class="main-nav" aria-label="Navegación principal">
                <div class="nav-brand-wrap">
                    <div class="sena-logo" role="img" aria-label="Logo SENA"></div>
                    <span class="sena-brand-name">AdminSena</span>
                </div>

                <div class="nav-links">
                    <div class="nav-dropdown">
                        <details>
                            <summary>Tablas</summary>
                            <div class="nav-submenu">
                                <a href="{{ url('/computers') }}">Computadores</a>
                                <a href="{{ url('/apprentices') }}">Aprendices</a>
                                <a href="{{ url('/areas') }}">Áreas</a>
                                <a href="{{ url('/courses') }}">Cursos</a>
                                <a href="{{ url('/course-teachers') }}">Asignaciones</a>
                                <a href="{{ url('/teachers') }}">Instructores</a>
                                <a href="{{ url('/training-centers') }}">Centros de formación</a>
                            </div>
                        </details>
                    </div>
                </div>

                <a href="{{ url('/login') }}" class="nav-login">Inicio / Registro</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @endif
    {{-- El pie se comparte entre las páginas públicas y los listados administrativos. --}}
    @include('Includes.footer')
    @include('Includes.dependenciasbody')
    @stack('scripts')
</body>
</html>