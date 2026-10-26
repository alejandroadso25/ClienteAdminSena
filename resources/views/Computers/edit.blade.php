@extends('Layouts.app')

@section('title', 'Editar computador | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="computer-edit-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Inventario</p>
                <h1 id="computer-edit-title">Editar computador</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('computers.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('computers.update', $computer['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="computer-number">Número</label>
                <input class="form-control" id="computer-number" name="number" value="{{ old('number', $computer['number'] ?? '') }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="computer-brand">Marca</label>
                <input class="form-control" id="computer-brand" name="brand" value="{{ old('brand', $computer['brand'] ?? '') }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="computer-image">Reemplazar imagen (opcional)</label>
                <input class="form-control" id="computer-image" name="image" type="file" accept="image/*">
            </div>
            <button class="btn btn-primary" type="submit">Guardar cambios</button>
            <a class="btn btn-outline-secondary" href="{{ route('computers.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
