@extends('Layouts.app')

@section('title', 'Áreas | AdminSena')

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
                {{-- El controlador entrega las áreas para renderizar la tabla en el servidor. --}}
                <tbody>
                    @forelse ($areas as $area)
                        <tr>
                            <td>{{ $area['name'] ?? '' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ count($columns) }}">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection