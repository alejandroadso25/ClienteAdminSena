@extends('Layouts.app')

@section('title', 'Cursos | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="catalog-title">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="catalog-title" class="mb-2">Cursos</h1>
                <p class="text-secondary mb-0">Cursos registrados en el sistema.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-primary" href="{{ route('courses.create') }}">Nuevo curso</a>
                <a class="btn btn-outline-secondary" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        @if (session('status'))
            <p class="alert alert-success" role="status">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if ($showForm)
            {{-- El backend valida los datos del curso al recibir este POST. --}}
            <form class="page" method="POST" action="{{ route('courses.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="form-field" for="course-number">
                        <span>Número de ficha</span>
                        <input id="course-number" name="course_number" type="text" value="{{ old('course_number') }}" maxlength="255" required>
                    </label>
                    <label class="form-field" for="course-day">
                        <span>Día</span>
                        <input id="course-day" name="day" type="text" value="{{ old('day') }}" maxlength="255">
                    </label>
                    <label class="form-field" for="course-area">
                        <span>Área</span>
                        <select id="course-area" name="area_id">
                            <option value="">Sin área</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area['id'] }}" @selected((string) old('area_id') === (string) $area['id'])>{{ $area['name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="form-field" for="course-training-center">
                        <span>Centro de formación</span>
                        <select id="course-training-center" name="training_center_id">
                            <option value="">Sin centro</option>
                            @foreach ($trainingCenters as $trainingCenter)
                                <option value="{{ $trainingCenter['id'] }}" @selected((string) old('training_center_id') === (string) $trainingCenter['id'])>{{ $trainingCenter['name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="primary-button" type="submit">Crear curso</button>
                    <a class="secondary-button" href="{{ route('courses.index') }}">Cancelar</a>
                </div>
            </form>
        @endif

        {{-- El controlador entrega a esta vista la colección de cursos consultada en el API. --}}
        {{-- Bootstrap aplica estilos y permite desplazar la tabla en pantallas estrechas. --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Imágenes</th>
                        <th scope="col">Programa / ficha</th>
                        <th scope="col">Día</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>
                                @forelse (collect(data_get($course, 'images', []))->filter(fn ($image) => data_get($image, 'path')) as $courseImage)
                                    @php
                                        $imagePath = data_get($courseImage, 'path');
                                        // Conserva URLs externas y resuelve las rutas relativas desde el storage del API.
                                        $imageUrl = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])
                                            ? $imagePath
                                            : rtrim($storageUrl, '/') . '/' . ltrim($imagePath, '/');
                                    @endphp
                                    <img class="img-thumbnail me-1 mb-1" style="width: 4rem; height: 4rem; object-fit: cover;" src="{{ $imageUrl }}" alt="{{ data_get($courseImage, 'alt_text', 'Curso ' . data_get($course, 'course_number', '')) }}" loading="lazy">
                                @empty
                                    <span class="text-secondary">Sin imagen</span>
                                @endforelse
                            </td>
                            <td>{{ data_get($course, 'program_name') ?: data_get($course, 'course_number', 'Sin nombre') }}</td>
                            <td>{{ $course['day'] ?? '' }}</td>
                            <td>
                                @if (!empty($course['id']))
                                    <div class="d-flex flex-wrap gap-2">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('courses.show', $course['id']) }}">Ver</a>
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('courses.edit', $course['id']) }}">Editar</a>
                                        <form method="POST" action="{{ route('courses.destroy', $course['id']) }}" onsubmit="return confirm('¿Eliminar este curso?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection