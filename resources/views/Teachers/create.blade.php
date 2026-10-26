@extends('Layouts.app')

@section('title', 'Crear instructor | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="teacher-create-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="teacher-create-title">Crear instructor</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('teachers.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        {{-- El formulario conserva los datos de instructor y relaciones existentes en el módulo. --}}
        <form method="POST" action="{{ route('teachers.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="teacher-name">Nombre</label>
                <input class="form-control" id="teacher-name" name="name" value="{{ old('name') }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="teacher-email">Correo</label>
                <input class="form-control" id="teacher-email" name="email" type="email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="teacher-area">Área</label>
                <select class="form-select" id="teacher-area" name="area_id">
                    <option value="">Sin área</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area['id'] }}" @selected((string) old('area_id') === (string) $area['id'])>{{ $area['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="teacher-training-center">Centro de formación</label>
                <select class="form-select" id="teacher-training-center" name="training_center_id">
                    <option value="">Sin centro</option>
                    @foreach ($trainingCenters as $trainingCenter)
                        <option value="{{ $trainingCenter['id'] }}" @selected((string) old('training_center_id') === (string) $trainingCenter['id'])>{{ $trainingCenter['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Crear instructor</button>
            <a class="btn btn-outline-secondary" href="{{ route('teachers.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
