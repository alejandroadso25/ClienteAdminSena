@extends('Layouts.app')

@section('title', 'Editar aprendiz | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="apprentice-edit-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">REGISTROS</p>
                <h1 id="apprentice-edit-title">Editar aprendiz</h1>
                <p>Actualiza la información del aprendiz.</p>
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

        {{-- El formulario reutiliza los campos de creación y envía los cambios mediante PUT. --}}
        <form class="page" method="POST" action="{{ route('apprentices.update', $apprentice['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <label class="form-field" for="apprentice-name">
                    <span>Nombre</span>
                    <input id="apprentice-name" name="name" type="text" value="{{ old('name', $apprentice['name'] ?? '') }}" maxlength="255" required>
                </label>
                <label class="form-field" for="apprentice-email">
                    <span>Correo</span>
                    <input id="apprentice-email" name="email" type="email" value="{{ old('email', $apprentice['email'] ?? '') }}" maxlength="255" required>
                </label>
                <label class="form-field" for="apprentice-cell-number">
                    <span>Celular</span>
                    <input id="apprentice-cell-number" name="cell_number" type="text" value="{{ old('cell_number', $apprentice['cell_number'] ?? '') }}" maxlength="255">
                </label>
                <label class="form-field" for="apprentice-image">
                    <span>Reemplazar imagen (opcional)</span>
                    <input id="apprentice-image" name="image" type="file" accept="image/*">
                </label>
                <label class="form-field" for="apprentice-course">
                    <span>Curso</span>
                    <select id="apprentice-course" name="course_id" required>
                        @foreach ($courses as $course)
                            <option
                                value="{{ $course['id'] }}"
                                @selected((string) old('course_id', data_get($apprentice, 'course_id', data_get($apprentice, 'course.id'))) === (string) $course['id'])>
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
                            <option
                                value="{{ $computer['id'] }}"
                                @selected((string) old('computer_id', data_get($apprentice, 'computer_id', data_get($apprentice, 'computer.id'))) === (string) $computer['id'])>
                                {{ $computer['number'] ?? 'Computador ' . $computer['id'] }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="modal-actions">
                <button class="primary-button" type="submit">Guardar cambios</button>
                <a class="secondary-button" href="{{ route('apprentices.index') }}">Cancelar</a>
            </div>
        </form>
    </section>
@endsection
