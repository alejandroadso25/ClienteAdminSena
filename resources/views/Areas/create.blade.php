@extends('Layouts.app')

@section('title', 'Crear área | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="area-create-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="area-create-title">Crear área</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('areas.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        {{-- El formulario conserva el campo name que ya recibe la API de áreas. --}}
        <form method="POST" action="{{ route('areas.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="area-name">Nombre</label>
                <input class="form-control" id="area-name" name="name" value="{{ old('name') }}" maxlength="255" required>
            </div>
            <button class="btn btn-primary" type="submit">Crear área</button>
            <a class="btn btn-outline-secondary" href="{{ route('areas.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
