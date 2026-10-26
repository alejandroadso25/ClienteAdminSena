@extends('Layouts.app')

@section('title', 'Asignaciones | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="catalog-title">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Registros</p>
                <h1 id="catalog-title" class="mb-2">Asignaciones curso-instructor</h1>
                <p class="text-secondary mb-0">Asignaciones académicas registradas.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-primary" href="{{ route('course-teachers.create') }}">Nueva asignación</a>
                <a class="btn btn-outline-secondary" href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </div>

        @if (session('status'))
            <p class="alert alert-success" role="status">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
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
        {{-- Bootstrap aplica estilos y permite desplazar la tabla en pantallas estrechas. --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Curso</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courseTeachers as $courseTeacher)
                        <tr>
                            <td>{{ data_get($courseTeacher, 'course.program_name') }}</td>
                            <td>{{ data_get($courseTeacher, 'teacher.name') }}</td>
                            <td>
                                @if (!empty($courseTeacher['id']))
                                    <div class="d-flex flex-wrap gap-2">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('course-teachers.show', $courseTeacher['id']) }}">Ver</a>
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('course-teachers.edit', $courseTeacher['id']) }}">Editar</a>
                                        <form method="POST" action="{{ route('course-teachers.destroy', $courseTeacher['id']) }}" onsubmit="return confirm('¿Eliminar esta asignación?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection