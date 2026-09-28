{{-- Navegación compartida por todas las pantallas de los CRUD. --}}
<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    {{-- El logo siempre devuelve al inicio del proyecto. --}}
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" aria-label="Ir al inicio de AdminSena">
      <span class="sena-logo" role="img" aria-label="Logo SENA"></span>
      <span class="ms-2">AdminSena</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ route('areas.index') }}">Áreas</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('training-centers.index') }}">Centros de Formación</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('computers.index') }}">Computadores</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('courses.index') }}">Cursos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('teachers.index') }}">Instructores</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('apprentices.index') }}">Aprendices</a></li>
      </ul>
    </div>
  </div>
</nav>
