@extends('Layouts.app')

@section('title', 'Editar instructor | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="teacher-edit-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="teacher-edit-title">Editar instructor</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('teachers.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('teachers.update', $teacher['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="teacher-name">Nombre</label>
                <input class="form-control" id="teacher-name" name="name" value="{{ old('name', $teacher['name'] ?? '') }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="teacher-email">Correo</label>
                <input class="form-control" id="teacher-email" name="email" type="email" value="{{ old('email', $teacher['email'] ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="teacher-image">Reemplazar imagen (opcional)</label>
                <input class="form-control" id="teacher-image" name="image" type="file" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label" for="teacher-area">Área</label>
                <select class="form-select" id="teacher-area" name="area_id">
                    <option value="">Sin área</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area['id'] }}" @selected((string) old('area_id', data_get($teacher, 'area_id', data_get($teacher, 'area.id'))) === (string) $area['id'])>{{ $area['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="teacher-training-center">Centro de formación</label>
                <select class="form-select" id="teacher-training-center" name="training_center_id">
                    <option value="">Sin centro</option>
                    @foreach ($trainingCenters as $trainingCenter)
                        <option value="{{ $trainingCenter['id'] }}" @selected((string) old('training_center_id', data_get($teacher, 'training_center_id', data_get($teacher, 'training_center.id'))) === (string) $trainingCenter['id'])>{{ $trainingCenter['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Guardar cambios</button>
            <a class="btn btn-outline-secondary" href="{{ route('teachers.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
