@extends('Layouts.app')

@section('title', 'Áreas | AdminSena')

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
                <h1 id="catalog-title" class="mb-2">Áreas</h1>
                <p class="text-secondary mb-0">Áreas de formación registradas.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-primary" href="{{ route('areas.create') }}">Nueva área</a>
                <a class="btn btn-outline-secondary" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        {{-- El formulario crea áreas; las modificaciones quedan a cargo del API central. --}}
        @if ($showForm ?? false)
            <form class="page" method="POST" action="{{ route('areas.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="form-field full-width" for="area-name">
                        <span>Nombre</span>
                        <input id="area-name" name="name" type="text" value="{{ old('name') }}" maxlength="255" required>
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="primary-button" type="submit">Crear área</button>
                    <a class="secondary-button" href="{{ route('areas.index') }}">Cancelar</a>
                </div>
            </form>
        @endif

        {{-- La tabla presenta los registros recibidos desde el API por el controlador. --}}
        {{-- Bootstrap aplica estilos y permite desplazar la tabla en pantallas estrechas. --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($areas as $area)
                        <tr>
                            <td>{{ $area['name'] ?? '' }}</td>
                            <td>
                                @if (!empty($area['id']))
                                    <div class="d-flex flex-wrap gap-2">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('areas.show', $area['id']) }}">Ver</a>
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('areas.edit', $area['id']) }}">Editar</a>
                                        <form method="POST" action="{{ route('areas.destroy', $area['id']) }}" onsubmit="return confirm('¿Eliminar esta área?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection