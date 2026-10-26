@extends('Layouts.app')

@section('title', 'Aprendices')

@section('content')
    <section class="container py-4" aria-labelledby="catalog-title">
        @if (session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="catalog-title" class="mb-2">Aprendices</h1>
                <p class="text-secondary mb-0">Directorio de aprendices registrados.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-primary" href="{{ route('apprentices.create') }}">Nuevo aprendiz</a>
                <a class="btn btn-outline-secondary" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        {{-- El listado usa los aprendices que el controlador consulta en el API central. --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr class="table-light">
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($apprentices as $apprentice)
                        <tr>
                            <td>
                                @if (data_get($apprentice, 'image.path'))
                                    <img class="img-thumbnail" style="width: 4rem; height: 4rem; object-fit: cover;" src="{{ rtrim(config('services.adminsena_api.storage_url'), '/') . '/' . ltrim(data_get($apprentice, 'image.path'), '/') }}" alt="{{ data_get($apprentice, 'image.alt_text', 'Aprendiz ' . data_get($apprentice, 'name', '')) }}" loading="lazy">
                                @else
                                    <span class="text-secondary">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $apprentice['name'] ?? '' }}</td>
                            <td>{{ $apprentice['email'] ?? '' }}</td>
                            <td>{{ $apprentice['cell_number'] ?? '' }}</td>
                            <td>
                                @if (!empty($apprentice['id']))
                                    <div class="d-flex flex-wrap gap-2">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('apprentices.show', $apprentice['id']) }}">Ver</a>
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('apprentices.edit', $apprentice['id']) }}">Editar</a>
                                        <form method="POST" action="{{ route('apprentices.destroy', $apprentice['id']) }}" onsubmit="return confirm('¿Eliminar este aprendiz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-secondary py-4">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection