@extends('Layouts.app')

@section('title', 'Crear aprendiz | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="apprentice-create-title">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="apprentice-create-title" class="mb-2">Crear aprendiz</h1>
                <p class="text-secondary mb-0">Registra un aprendiz en el sistema.</p>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('apprentices.index') }}">Volver al listado</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {{-- El formulario crea mediante POST y deja la validación del recurso al backend. --}}
        {{-- Bootstrap organiza los campos en dos columnas y los apila en pantallas pequeñas. --}}
        <form class="row g-3" method="POST" action="{{ route('apprentices.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-name">Nombre</label>
                <input class="form-control" id="apprentice-name" name="name" type="text" value="{{ old('name') }}" maxlength="255" required>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-email">Correo</label>
                <input class="form-control" id="apprentice-email" name="email" type="email" value="{{ old('email') }}" maxlength="255" required>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-cell-number">Celular</label>
                <input class="form-control" id="apprentice-cell-number" name="cell_number" type="text" value="{{ old('cell_number') }}" maxlength="255">
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-image">Imagen</label>
                <input class="form-control" id="apprentice-image" name="image" type="file" accept="image/*">
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-course">Curso</label>
                <select class="form-select" id="apprentice-course" name="course_id" required>
                        @foreach ($courses as $course)
                            <option value="{{ $course['id'] }}" @selected((string) old('course_id') === (string) $course['id'])>
                                {{ $course['course_number'] ?? 'Curso ' . $course['id'] }}
                            </option>
                        @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-computer">Computador asignado</label>
                <select class="form-select" id="apprentice-computer" name="computer_id">
                        <option value="">Sin computador</option>
                        @foreach ($computers as $computer)
                            <option value="{{ $computer['id'] }}" @selected((string) old('computer_id') === (string) $computer['id'])>
                                {{ $computer['number'] ?? 'Computador ' . $computer['id'] }}
                            </option>
                        @endforeach
                </select>
            </div>
            <div class="col-12">
                <p class="form-text">Formatos de imagen admitidos por el servidor.</p>
                <button class="btn btn-primary" type="submit">Crear aprendiz</button>
                <a class="btn btn-outline-secondary" href="{{ route('apprentices.index') }}">Cancelar</a>
            </div>
        </form>
    </section>
@endsection