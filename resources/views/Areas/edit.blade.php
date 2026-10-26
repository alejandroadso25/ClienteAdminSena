@extends('Layouts.app')

@section('title', 'Editar área | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="area-edit-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="area-edit-title">Editar área</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('areas.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('areas.update', $area['id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="area-name">Nombre</label>
                <input class="form-control" id="area-name" name="name" value="{{ old('name', $area['name'] ?? '') }}" maxlength="255" required>
            </div>
            <button class="btn btn-primary" type="submit">Guardar cambios</button>
            <a class="btn btn-outline-secondary" href="{{ route('areas.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
