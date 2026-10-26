@extends('Layouts.app')

@section('title', 'Instructores | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="catalog-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">REGISTROS</p>
                <h1 id="catalog-title">Instructores</h1>
                <p>Directorio de instructores registrados.</p>
            </div>
            <div class="modal-actions">
                <a class="primary-button" href="{{ route('teachers.create') }}">Nuevo instructor</a>
                <a class="secondary-button" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        @if (session('status'))
            <p class="success-message" role="status">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div class="error-message" role="alert">
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
        <div class="table-wrapper">
            <table>
                <thead>
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
                                    <img class="record-thumbnail" src="{{ rtrim($storageUrl, '/') . '/' . ltrim(data_get($teacher, 'image.path'), '/') }}" alt="{{ data_get($teacher, 'image.alt_text', 'Instructor ' . data_get($teacher, 'name', '')) }}" loading="lazy">
                                @else
                                    <span class="image-unavailable">Sin imagen</span>
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