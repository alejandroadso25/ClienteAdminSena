@extends('Layouts.app')

@section('title', 'Crear aprendiz | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="apprentice-create-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">REGISTROS</p>
                <h1 id="apprentice-create-title">Crear aprendiz</h1>
                <p>Registra un aprendiz en el sistema.</p>
            </div>
            <a class="secondary-button" href="{{ route('apprentices.index') }}">Volver al listado</a>
        </div>

        @if ($errors->any())
            <div class="error-message" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {{-- El formulario crea mediante POST y deja la validación del recurso al backend. --}}
        <form class="page" method="POST" action="{{ route('apprentices.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <label class="form-field" for="apprentice-name">
                    <span>Nombre</span>
                    <input id="apprentice-name" name="name" type="text" value="{{ old('name') }}" maxlength="255" required>
                </label>
                <label class="form-field" for="apprentice-email">
                    <span>Correo</span>
                    <input id="apprentice-email" name="email" type="email" value="{{ old('email') }}" maxlength="255" required>
                </label>
                <label class="form-field" for="apprentice-cell-number">
                    <span>Celular</span>
                    <input id="apprentice-cell-number" name="cell_number" type="text" value="{{ old('cell_number') }}" maxlength="255">
                </label>
                <label class="form-field" for="apprentice-image">
                    <span>Imagen</span>
                    <input id="apprentice-image" name="image" type="file" accept="image/*">
                </label>
                <label class="form-field" for="apprentice-course">
                    <span>Curso</span>
                    <select id="apprentice-course" name="course_id" required>
                        @foreach ($courses as $course)
                            <option value="{{ $course['id'] }}" @selected((string) old('course_id') === (string) $course['id'])>
                                {{ $course['course_number'] ?? 'Curso ' . $course['id'] }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label class="form-field" for="apprentice-computer">
                    <span>Computador asignado</span>
                    <select id="apprentice-computer" name="computer_id">
                        <option value="">Sin computador</option>
                        @foreach ($computers as $computer)
                            <option value="{{ $computer['id'] }}" @selected((string) old('computer_id') === (string) $computer['id'])>
                                {{ $computer['number'] ?? 'Computador ' . $computer['id'] }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>
            {{-- El navegador no puede restaurar archivos elegidos si hay errores de validación. --}}
            <p class="form-text">Formatos de imagen admitidos por el servidor.</p>
            <div class="modal-actions">
                <button class="primary-button" type="submit">Crear aprendiz</button>
                <a class="secondary-button" href="{{ route('apprentices.index') }}">Cancelar</a>
            </div>
        </form>
    </section>
@endsection
