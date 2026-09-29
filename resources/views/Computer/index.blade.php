@extends('Layouts.app')

@section('title', 'Computadores | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="computers-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">INVENTARIO</p>
                <h1 id="computers-title">Computadores</h1>
                <p>Equipos registrados en el sistema.</p>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Número</th>
                        <th scope="col">Marca</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($computers as $computer)
                        <tr>
                            <td>
                                @if (data_get($computer, 'image.path'))
                                    <img class="record-thumbnail" src="{{ rtrim(config('services.adminsena_api.storage_url'), '/') . '/' . ltrim(data_get($computer, 'image.path'), '/') }}" alt="{{ data_get($computer, 'image.alt_text', 'Computador ' . data_get($computer, 'number', '')) }}" loading="lazy">
                                @else
                                    <span class="image-unavailable">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $computer['number'] ?? '' }}</td>
                            <td>{{ $computer['brand'] ?? '' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ count($columns) }}">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a class="text-button" href="{{ url('/') }}">Volver al inicio</a>
    </section>
@endsection