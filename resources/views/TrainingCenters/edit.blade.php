@extends('Layouts.app')

@section('title', 'Editar centro de formación | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="training-center-edit-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="training-center-edit-title">Editar centro de formación</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('training-centers.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('training-centers.update', $trainingCenter['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="training-center-name">Nombre</label>
                <input class="form-control" id="training-center-name" name="name" value="{{ old('name', $trainingCenter['name'] ?? '') }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="training-center-location">Ubicación</label>
                <input class="form-control" id="training-center-location" name="location" value="{{ old('location', $trainingCenter['location'] ?? '') }}" maxlength="255">
            </div>
            <div class="mb-3">
                <label class="form-label" for="training-center-image">Reemplazar imagen (opcional)</label>
                <input class="form-control" id="training-center-image" name="image" type="file" accept="image/*">
            </div>
            <button class="btn btn-primary" type="submit">Guardar cambios</button>
            <a class="btn btn-outline-secondary" href="{{ route('training-centers.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
