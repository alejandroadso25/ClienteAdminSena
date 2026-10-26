@extends('Layouts.app')

@section('title', 'Editar aprendiz | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="apprentice-edit-title">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="apprentice-edit-title" class="mb-2">Editar aprendiz</h1>
                <p class="text-secondary mb-0">Actualiza la información del aprendiz.</p>
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

        {{-- El formulario reutiliza los campos de creación y envía los cambios mediante PUT. --}}
        {{-- Bootstrap organiza los campos en dos columnas y los apila en pantallas pequeñas. --}}
        <form class="row g-3" method="POST" action="{{ route('apprentices.update', $apprentice['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-name">Nombre</label>
                <input class="form-control" id="apprentice-name" name="name" type="text" value="{{ old('name', $apprentice['name'] ?? '') }}" maxlength="255" required>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-email">Correo</label>
                <input class="form-control" id="apprentice-email" name="email" type="email" value="{{ old('email', $apprentice['email'] ?? '') }}" maxlength="255" required>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-cell-number">Celular</label>
                <input class="form-control" id="apprentice-cell-number" name="cell_number" type="text" value="{{ old('cell_number', $apprentice['cell_number'] ?? '') }}" maxlength="255">
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-image">Reemplazar imagen (opcional)</label>
                <input class="form-control" id="apprentice-image" name="image" type="file" accept="image/*">
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="apprentice-course">Curso</label>
                <select class="form-select" id="apprentice-course" name="course_id" required>
                        @foreach ($courses as $course)
                            <option
                                value="{{ $course['id'] }}"
                                @selected((string) old('course_id', data_get($apprentice, 'course_id', data_get($apprentice, 'course.id'))) === (string) $course['id'])>
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
                            <option
                                value="{{ $computer['id'] }}"
                                @selected((string) old('computer_id', data_get($apprentice, 'computer_id', data_get($apprentice, 'computer.id'))) === (string) $computer['id'])>
                                {{ $computer['number'] ?? 'Computador ' . $computer['id'] }}
                            </option>
                        @endforeach
                </select>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Guardar cambios</button>
                <a class="btn btn-outline-secondary" href="{{ route('apprentices.index') }}">Cancelar</a>
            </div>
        </form>
    </section>
@endsection
