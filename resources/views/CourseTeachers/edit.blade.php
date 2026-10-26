@extends('Layouts.app')

@section('title', 'Editar asignación | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="assignment-edit-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="assignment-edit-title">Editar asignación</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('course-teachers.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('course-teachers.update', $courseTeacher['id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="assignment-course">Curso</label>
                <select class="form-select" id="assignment-course" name="course_id" required>
                    <option value="">Selecciona un curso</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course['id'] }}" @selected((string) old('course_id', data_get($courseTeacher, 'course_id', data_get($courseTeacher, 'course.id'))) === (string) $course['id'])>{{ $course['course_number'] ?? $course['id'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="assignment-teacher">Instructor</label>
                <select class="form-select" id="assignment-teacher" name="teacher_id" required>
                    <option value="">Selecciona un instructor</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher['id'] }}" @selected((string) old('teacher_id', data_get($courseTeacher, 'teacher_id', data_get($courseTeacher, 'teacher.id'))) === (string) $teacher['id'])>{{ $teacher['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Guardar cambios</button>
            <a class="btn btn-outline-secondary" href="{{ route('course-teachers.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
