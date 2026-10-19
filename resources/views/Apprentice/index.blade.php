@extends('Layouts.app')

@section('title', 'Aprendices | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="catalog-title">
        @if (session('status'))
            <p class="success-message" role="status">{{ session('status') }}</p>
        @endif

        <div class="page-heading">
            <div>
                <p class="eyebrow">REGISTROS</p>
                <h1 id="catalog-title">Aprendices</h1>
                <p>Directorio de aprendices registrados.</p>
            </div>
            <div class="modal-actions">
                <a class="primary-button" href="{{ route('apprentices.create') }}">Nuevo aprendiz</a>
                <a class="secondary-button" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        {{-- El listado usa los aprendices que el controlador consulta en el API central. --}}
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Celular</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($apprentices as $apprentice)
                        <tr>
                            <td>
                                @if (data_get($apprentice, 'image.path'))
                                    <img class="record-thumbnail" src="{{ rtrim(config('services.adminsena_api.storage_url'), '/') . '/' . ltrim(data_get($apprentice, 'image.path'), '/') }}" alt="{{ data_get($apprentice, 'image.alt_text', 'Aprendiz ' . data_get($apprentice, 'name', '')) }}" loading="lazy">
                                @else
                                    <span class="image-unavailable">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $apprentice['name'] ?? '' }}</td>
                            <td>{{ $apprentice['email'] ?? '' }}</td>
                            <td>{{ $apprentice['cell_number'] ?? '' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection