@extends('Layouts.app')

@section('title', 'Instructores | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="catalog-title">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="catalog-title" class="mb-2">Instructores</h1>
                <p class="text-secondary mb-0">Directorio de instructores registrados.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-primary" href="{{ route('teachers.create') }}">Nuevo instructor</a>
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
            {{-- El backend valida los datos del instructor al recibir este POST. --}}
            <form class="page" method="POST" action="{{ route('teachers.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="form-field" for="teacher-name">
                        <span>Nombre</span>
                        <input id="teacher-name" name="name" type="text" value="{{ old('name') }}" maxlength="255" required>
                    </label>
                    <label class="form-field" for="teacher-email">
                        <span>Correo</span>
                        <input id="teacher-email" name="email" type="email" value="{{ old('email') }}" required>
                    </label>
                    <label class="form-field" for="teacher-area">
                        <span>Área</span>
                        <select id="teacher-area" name="area_id">
                            <option value="">Sin área</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area['id'] }}" @selected((string) old('area_id') === (string) $area['id'])>{{ $area['name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="form-field" for="teacher-training-center">
                        <span>Centro de formación</span>
                        <select id="teacher-training-center" name="training_center_id">
                            <option value="">Sin centro</option>
                            @foreach ($trainingCenters as $trainingCenter)
                                <option value="{{ $trainingCenter['id'] }}" @selected((string) old('training_center_id') === (string) $trainingCenter['id'])>{{ $trainingCenter['name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="primary-button" type="submit">Crear instructor</button>
                    <a class="secondary-button" href="{{ route('teachers.index') }}">Cancelar</a>
                </div>
            </form>
        @endif

        {{-- El controlador entrega a esta vista los instructores consultados en el API. --}}
        {{-- Bootstrap aplica estilos y permite desplazar la tabla en pantallas estrechas. --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td>
                                @if (data_get($teacher, 'image.path'))
                                    @php
                                        $imagePath = data_get($teacher, 'image.path');
                                        // Conserva URLs externas y resuelve las rutas relativas desde el storage del API.
                                        $imageUrl = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])
                                            ? $imagePath
                                            : rtrim($storageUrl, '/') . '/' . ltrim($imagePath, '/');
                                    @endphp
                                    <img class="img-thumbnail" style="width: 4rem; height: 4rem; object-fit: cover;" src="{{ $imageUrl }}" alt="{{ data_get($teacher, 'image.alt_text', 'Instructor ' . data_get($teacher, 'name', '')) }}" loading="lazy">
                                @else
                                    <span class="text-secondary">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $teacher['name'] ?? '' }}</td>
                            <td>{{ $teacher['email'] ?? '' }}</td>
                            <td>
                                @if (!empty($teacher['id']))
                                    <div class="d-flex flex-wrap gap-2">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('teachers.show', $teacher['id']) }}">Ver</a>
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('teachers.edit', $teacher['id']) }}">Editar</a>
                                        <form method="POST" action="{{ route('teachers.destroy', $teacher['id']) }}" onsubmit="return confirm('¿Eliminar este instructor?');">
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