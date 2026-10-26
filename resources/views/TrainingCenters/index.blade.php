@extends('Layouts.app')

@section('title', 'Centros de formación | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="catalog-title">
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
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="catalog-title" class="mb-2">Centros de formación</h1>
                <p class="text-secondary mb-0">Centros de formación registrados.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-primary" href="{{ route('training-centers.create') }}">Nuevo centro</a>
                <a class="btn btn-outline-secondary" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        {{-- El formulario crea centros; las modificaciones quedan a cargo del API central. --}}
        @if ($showForm ?? false)
            <form class="page" method="POST" action="{{ route('training-centers.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="form-field" for="training-center-name">
                        <span>Nombre</span>
                        <input id="training-center-name" name="name" type="text" value="{{ old('name') }}" maxlength="255" required>
                    </label>
                    <label class="form-field" for="training-center-location">
                        <span>Ubicación</span>
                        <input id="training-center-location" name="location" type="text" value="{{ old('location') }}" maxlength="255">
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="primary-button" type="submit">Crear centro</button>
                    <a class="secondary-button" href="{{ route('training-centers.index') }}">Cancelar</a>
                </div>
            </form>
        @endif

        {{-- Las filas y sus imágenes se obtienen del API central. --}}
        {{-- Bootstrap aplica estilos y permite desplazar la tabla en pantallas estrechas. --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trainingCenters as $trainingCenter)
                        <tr>
                            <td>
                                @if (data_get($trainingCenter, 'image.path'))
                                    @php
                                        $imagePath = data_get($trainingCenter, 'image.path');
                                        // Conserva URLs externas y resuelve las rutas relativas desde el storage del API.
                                        $imageUrl = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])
                                            ? $imagePath
                                            : rtrim($storageUrl, '/') . '/' . ltrim($imagePath, '/');
                                    @endphp
                                    <img class="img-thumbnail" style="width: 4rem; height: 4rem; object-fit: cover;" src="{{ $imageUrl }}" alt="{{ data_get($trainingCenter, 'image.alt_text', 'Centro ' . data_get($trainingCenter, 'name', '')) }}" loading="lazy">
                                @else
                                    <span class="text-secondary">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $trainingCenter['name'] ?? '' }}</td>
                            <td>{{ $trainingCenter['location'] ?? '' }}</td>
                            <td>
                                @if (!empty($trainingCenter['id']))
                                    <div class="d-flex flex-wrap gap-2">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('training-centers.show', $trainingCenter['id']) }}">Ver</a>
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('training-centers.edit', $trainingCenter['id']) }}">Editar</a>
                                        <form method="POST" action="{{ route('training-centers.destroy', $trainingCenter['id']) }}" onsubmit="return confirm('¿Eliminar este centro de formación?');">
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