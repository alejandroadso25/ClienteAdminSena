@extends('Layouts.app')

@section('title', 'Crear centro de formación | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="training-center-create-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="training-center-create-title">Crear centro de formación</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('training-centers.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        {{-- El formulario conserva los campos de centro usados por el módulo actual. --}}
        <form method="POST" action="{{ route('training-centers.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="training-center-name">Nombre</label>
                <input class="form-control" id="training-center-name" name="name" value="{{ old('name') }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="training-center-location">Ubicación</label>
                <input class="form-control" id="training-center-location" name="location" value="{{ old('location') }}" maxlength="255">
            </div>
            <button class="btn btn-primary" type="submit">Crear centro</button>
            <a class="btn btn-outline-secondary" href="{{ route('training-centers.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
