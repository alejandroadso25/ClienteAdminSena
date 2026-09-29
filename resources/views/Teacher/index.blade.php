@extends('Layouts.app')

@section('title', 'Instructores | AdminSena')

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
                {{-- El controlador entrega los instructores para renderizar la tabla en el servidor. --}}
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td>
                                @if (data_get($teacher, 'image.path'))
                                    <img class="record-thumbnail" src="{{ rtrim(config('services.adminsena_api.storage_url'), '/') . '/' . ltrim(data_get($teacher, 'image.path'), '/') }}" alt="{{ data_get($teacher, 'image.alt_text', 'Instructor ' . data_get($teacher, 'name', '')) }}" loading="lazy">
                                @else
                                    <span class="image-unavailable">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $teacher['name'] ?? '' }}</td>
                            <td>{{ $teacher['email'] ?? '' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ count($columns) }}">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection