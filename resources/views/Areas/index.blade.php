@extends('Layouts.app')

@section('title', 'Áreas | AdminSena')

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
                <h1 id="catalog-title">Áreas</h1>
                <p>Áreas de formación registradas.</p>
            </div>
            <div class="modal-actions">
                <a class="primary-button" href="{{ route('areas.create') }}">Nueva área</a>
                <a class="secondary-button" href="{{ url('/') }}">Volver al inicio</a>
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
        <div class="table-wrapper">
            <table>
                <thead>
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