@extends('Layouts.app')

@section('title', 'Detalle del curso | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="course-show-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <h1 id="course-show-title">Detalle del curso</h1>
            <div class="d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('courses.edit', $course['id']) }}">Editar</a>
                <a class="btn btn-outline-secondary" href="{{ route('courses.index') }}">Volver al listado</a>
            </div>
        </div>
        <dl class="row">
            <dt class="col-sm-3">Número de ficha</dt><dd class="col-sm-9">{{ $course['course_number'] ?? '' }}</dd>
            <dt class="col-sm-3">Día</dt><dd class="col-sm-9">{{ $course['day'] ?? '' }}</dd>
            <dt class="col-sm-3">Área</dt><dd class="col-sm-9">{{ data_get($course, 'area.name', data_get($course, 'area_id', 'Sin área')) }}</dd>
            <dt class="col-sm-3">Centro de formación</dt><dd class="col-sm-9">{{ data_get($course, 'training_center.name', data_get($course, 'training_center_id', 'Sin centro')) }}</dd>
        </dl>
    </section>
@endsection
