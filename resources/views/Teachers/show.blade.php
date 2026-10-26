@extends('Layouts.app')

@section('title', 'Detalle del instructor | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="teacher-show-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <h1 id="teacher-show-title">Detalle del instructor</h1>
            <div class="d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('teachers.edit', $teacher['id']) }}">Editar</a>
                <a class="btn btn-outline-secondary" href="{{ route('teachers.index') }}">Volver al listado</a>
            </div>
        </div>
        <dl class="row">
            <dt class="col-sm-3">Nombre</dt><dd class="col-sm-9">{{ $teacher['name'] ?? '' }}</dd>
            <dt class="col-sm-3">Correo</dt><dd class="col-sm-9">{{ $teacher['email'] ?? '' }}</dd>
            <dt class="col-sm-3">Área</dt><dd class="col-sm-9">{{ data_get($teacher, 'area.name', data_get($teacher, 'area_id', 'Sin área')) }}</dd>
            <dt class="col-sm-3">Centro de formación</dt><dd class="col-sm-9">{{ data_get($teacher, 'training_center.name', data_get($teacher, 'training_center_id', 'Sin centro')) }}</dd>
        </dl>
    </section>
@endsection
