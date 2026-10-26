@extends('Layouts.app')

@section('title', 'Crear curso | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="course-create-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="course-create-title">Crear curso</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('courses.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        {{-- El formulario usa los campos de curso y las relaciones ya cargadas por el controlador. --}}
        <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="course-number">Número de ficha</label>
                <input class="form-control" id="course-number" name="course_number" value="{{ old('course_number') }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="course-day">Día</label>
                <input class="form-control" id="course-day" name="day" value="{{ old('day') }}" maxlength="255">
            </div>
            <div class="mb-3">
                <label class="form-label" for="course-area">Área</label>
                <select class="form-select" id="course-area" name="area_id">
                    <option value="">Sin área</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area['id'] }}" @selected((string) old('area_id') === (string) $area['id'])>{{ $area['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="course-training-center">Centro de formación</label>
                <select class="form-select" id="course-training-center" name="training_center_id">
                    <option value="">Sin centro</option>
                    @foreach ($trainingCenters as $trainingCenter)
                        <option value="{{ $trainingCenter['id'] }}" @selected((string) old('training_center_id') === (string) $trainingCenter['id'])>{{ $trainingCenter['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="course-images">Imágenes del curso</label>
                <input class="form-control" id="course-images" name="images[]" type="file" accept="image/*" multiple>
            </div>
            <button class="btn btn-primary" type="submit">Crear curso</button>
            <a class="btn btn-outline-secondary" href="{{ route('courses.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
