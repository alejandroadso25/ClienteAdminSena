@extends('Layouts.app')

@section('title', 'Asignaciones | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="catalog-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">REGISTROS</p>
                <h1 id="catalog-title">Asignaciones curso-instructor</h1>
                <p>Asignaciones académicas registradas.</p>
            </div>
            <div class="modal-actions">
                <a class="primary-button" href="{{ route('course-teachers.create') }}">Nueva asignación</a>
                <a class="secondary-button" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        @if (session('status'))
            <p class="success-message" role="status">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div class="error-message" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if ($showForm)
            {{-- El backend valida las relaciones de la asignación al recibir este POST. --}}
            <form class="page" method="POST" action="{{ route('course-teachers.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="form-field" for="assignment-course">
                        <span>Curso</span>
                        <select id="assignment-course" name="course_id" required>
                            <option value="">Selecciona un curso</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course['id'] }}" @selected((string) old('course_id') === (string) $course['id'])>{{ $course['course_number'] ?? $course['id'] }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="form-field" for="assignment-teacher">
                        <span>Instructor</span>
                        <select id="assignment-teacher" name="teacher_id" required>
                            <option value="">Selecciona un instructor</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher['id'] }}" @selected((string) old('teacher_id') === (string) $teacher['id'])>{{ $teacher['name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="primary-button" type="submit">Crear asignación</button>
                    <a class="secondary-button" href="{{ route('course-teachers.index') }}">Cancelar</a>
                </div>
            </form>
        @endif

        {{-- El controlador entrega las asignaciones curso-instructor consultadas en el API. --}}
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Curso</th>
                        <th scope="col">Instructor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courseTeachers as $courseTeacher)
                        <tr>
                            <td>{{ data_get($courseTeacher, 'course.program_name') }}</td>
                            <td>{{ data_get($courseTeacher, 'teacher.name') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection