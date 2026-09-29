@extends('Layouts.app')

@section('title', 'Aprendices | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="catalog-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">REGISTROS</p>
                <h1 id="catalog-title">{{ $title }}</h1>
                <p>{{ $description }}</p>
            </div>
            <a class="secondary-button" href="{{ url('/') }}">Volver al inicio</a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th scope="col">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                {{-- El controlador entrega los aprendices para renderizar la tabla en el servidor. --}}
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
                        <tr><td colspan="{{ count($columns) }}">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection