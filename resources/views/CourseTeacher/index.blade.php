@extends('Layouts.app')

@section('title', 'Asignaciones | AdminSena')

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
                {{-- El controlador entrega las asignaciones y sus relaciones incluidas por el API. --}}
                <tbody>
                    @forelse ($courseTeachers as $courseTeacher)
                        <tr>
                            <td>{{ data_get($courseTeacher, 'course.program_name') }}</td>
                            <td>{{ data_get($courseTeacher, 'teacher.name') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ count($columns) }}">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection