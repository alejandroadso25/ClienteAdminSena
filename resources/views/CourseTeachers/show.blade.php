@extends('Layouts.app')

@section('title', 'Detalle de asignación | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="assignment-show-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <h1 id="assignment-show-title">Detalle de asignación</h1>
            <div class="d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('course-teachers.edit', $courseTeacher['id']) }}">Editar</a>
                <a class="btn btn-outline-secondary" href="{{ route('course-teachers.index') }}">Volver al listado</a>
            </div>
        </div>
        <dl class="row">
            <dt class="col-sm-3">Curso</dt><dd class="col-sm-9">{{ data_get($courseTeacher, 'course.program_name', data_get($courseTeacher, 'course.course_number', data_get($courseTeacher, 'course_id', ''))) }}</dd>
            <dt class="col-sm-3">Instructor</dt><dd class="col-sm-9">{{ data_get($courseTeacher, 'teacher.name', data_get($courseTeacher, 'teacher_id', '')) }}</dd>
        </dl>
    </section>
@endsection
