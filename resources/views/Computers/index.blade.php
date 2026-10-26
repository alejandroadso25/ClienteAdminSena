@extends('Layouts.app')

@section('title', 'Computadores | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="computers-title">
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
                <p class="text-uppercase text-secondary mb-1">Inventario</p>
                <h1 id="computers-title" class="mb-2">Computadores</h1>
                <p class="text-secondary mb-0">Equipos registrados en el sistema.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-primary" href="{{ route('computers.create') }}">Nuevo computador</a>
                <a class="btn btn-outline-secondary" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        {{-- El formulario crea computadores; las modificaciones quedan a cargo del API central. --}}
        @if ($showForm ?? false)
            <form class="page" method="POST" action="{{ route('computers.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="form-field" for="computer-number">
                        <span>Número</span>
                        <input id="computer-number" name="number" type="text" value="{{ old('number') }}" maxlength="255" required>
                    </label>
                    <label class="form-field" for="computer-brand">
                        <span>Marca</span>
                        <input id="computer-brand" name="brand" type="text" value="{{ old('brand') }}" maxlength="255" required>
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="primary-button" type="submit">Crear computador</button>
                    <a class="secondary-button" href="{{ route('computers.index') }}">Cancelar</a>
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
                        <th scope="col">Número</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($computers as $computer)
                        <tr>
                            <td>
                                @if (data_get($computer, 'image.path'))
                                    @php
                                        $imagePath = data_get($computer, 'image.path');
                                        // Conserva URLs externas y resuelve las rutas relativas desde el storage del API.
                                        $imageUrl = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])
                                            ? $imagePath
                                            : rtrim($storageUrl, '/') . '/' . ltrim($imagePath, '/');
                                    @endphp
                                    <img class="img-thumbnail" style="width: 4rem; height: 4rem; object-fit: cover;" src="{{ $imageUrl }}" alt="{{ data_get($computer, 'image.alt_text', 'Computador ' . data_get($computer, 'number', '')) }}" loading="lazy">
                                @else
                                    <span class="text-secondary">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $computer['number'] ?? '' }}</td>
                            <td>{{ $computer['brand'] ?? '' }}</td>
                            <td>
                                @if (!empty($computer['id']))
                                    <div class="d-flex flex-wrap gap-2">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('computers.show', $computer['id']) }}">Ver</a>
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('computers.edit', $computer['id']) }}">Editar</a>
                                        <form method="POST" action="{{ route('computers.destroy', $computer['id']) }}" onsubmit="return confirm('¿Eliminar este computador?');">
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