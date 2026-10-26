@extends('Layouts.app')

@section('title', 'Centros de formación | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="catalog-title">
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
        <div class="page-heading">
            <div>
                <p class="eyebrow">REGISTROS</p>
                <h1 id="catalog-title">Centros de formación</h1>
                <p>Centros de formación registrados.</p>
            </div>
            <div class="modal-actions">
                <a class="primary-button" href="{{ route('training-centers.create') }}">Nuevo centro</a>
                <a class="secondary-button" href="{{ url('/') }}">Volver al inicio</a>
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
        <div class="table-wrapper">
            <table>
                <thead>
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
                                    <img class="record-thumbnail" src="{{ rtrim(config('services.adminsena_api.storage_url'), '/') . '/' . ltrim(data_get($trainingCenter, 'image.path'), '/') }}" alt="{{ data_get($trainingCenter, 'image.alt_text', 'Centro ' . data_get($trainingCenter, 'name', '')) }}" loading="lazy">
                                @else
                                    <span class="image-unavailable">Sin imagen</span>
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