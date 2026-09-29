@extends('Layouts.app')

@section('title', 'Cursos | AdminSena')

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
                {{-- El controlador entrega los cursos para renderizar la tabla en el servidor. --}}
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>
                                @forelse (collect(data_get($course, 'images', []))->filter(fn ($image) => data_get($image, 'path')) as $courseImage)
                                    <img class="record-thumbnail" src="{{ rtrim(config('services.adminsena_api.storage_url'), '/') . '/' . ltrim(data_get($courseImage, 'path'), '/') }}" alt="{{ data_get($courseImage, 'alt_text', 'Curso ' . data_get($course, 'course_number', '')) }}" loading="lazy">
                                @empty
                                    <span class="image-unavailable">Sin imagen</span>
                                @endforelse
                            </td>
                            <td>{{ data_get($course, 'program_name') ?: data_get($course, 'course_number', 'Sin nombre') }}</td>
                            <td>{{ $course['day'] ?? '' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ count($columns) }}">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection