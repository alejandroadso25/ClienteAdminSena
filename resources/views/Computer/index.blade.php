@extends('Layouts.app')

@section('title', 'Computadores | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="computers-title">
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
                <p class="eyebrow">INVENTARIO</p>
                <h1 id="computers-title">Computadores</h1>
                <p>Equipos registrados en el sistema.</p>
            </div>
            <div class="modal-actions">
                <a class="primary-button" href="{{ route('computers.create') }}">Nuevo computador</a>
                <a class="secondary-button" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        {{-- El formulario crea computadores; las modificaciones quedan a cargo del API central. --}}
        @if ($showForm ?? false)
            <form class="page" method="POST" action="{{ route('computers.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="form-field" for="computer-number">
                        <span>Número</span>
                        <input id="computer-number" name="number" type="text" value="{{ old('number') }}" maxlength="255" required>
                    </label>
                    <label class="form-field" for="computer-brand">
                        <span>Marca</span>
                        <input id="computer-brand" name="brand" type="text" value="{{ old('brand') }}" maxlength="255" required>
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="primary-button" type="submit">Crear computador</button>
                    <a class="secondary-button" href="{{ route('computers.index') }}">Cancelar</a>
                </div>
            </form>
        @endif

        {{-- Las filas y sus imágenes se obtienen del API central. --}}
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
                                    <img class="record-thumbnail" src="{{ asset('storage/' . ltrim(data_get($computer, 'image.path'), '/')) }}" alt="{{ data_get($computer, 'image.alt_text', 'Computador ' . data_get($computer, 'number', '')) }}" loading="lazy">
                                @else
                                    <span class="image-unavailable">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $computer['number'] ?? '' }}</td>
                            <td>{{ $computer['brand'] ?? '' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection