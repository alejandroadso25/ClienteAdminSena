@extends('Layouts.app')

@section('title', 'Cursos | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="catalog-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">REGISTROS</p>
                <h1 id="catalog-title">Cursos</h1>
                <p>Cursos registrados en el sistema.</p>
            </div>
            <div class="modal-actions">
                <a class="primary-button" href="{{ route('courses.create') }}">Nuevo curso</a>
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
            {{-- El backend valida los datos del curso al recibir este POST. --}}
            <form class="page" method="POST" action="{{ route('courses.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="form-field" for="course-number">
                        <span>Número de ficha</span>
                        <input id="course-number" name="course_number" type="text" value="{{ old('course_number') }}" maxlength="255" required>
                    </label>
                    <label class="form-field" for="course-day">
                        <span>Día</span>
                        <input id="course-day" name="day" type="text" value="{{ old('day') }}" maxlength="255">
                    </label>
                    <label class="form-field" for="course-area">
                        <span>Área</span>
                        <select id="course-area" name="area_id">
                            <option value="">Sin área</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area['id'] }}" @selected((string) old('area_id') === (string) $area['id'])>{{ $area['name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="form-field" for="course-training-center">
                        <span>Centro de formación</span>
                        <select id="course-training-center" name="training_center_id">
                            <option value="">Sin centro</option>
                            @foreach ($trainingCenters as $trainingCenter)
                                <option value="{{ $trainingCenter['id'] }}" @selected((string) old('training_center_id') === (string) $trainingCenter['id'])>{{ $trainingCenter['name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="primary-button" type="submit">Crear curso</button>
                    <a class="secondary-button" href="{{ route('courses.index') }}">Cancelar</a>
                </div>
            </form>
        @endif

        {{-- El controlador entrega a esta vista la colección de cursos consultada en el API. --}}
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Imágenes</th>
                        <th scope="col">Programa / ficha</th>
                        <th scope="col">Día</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>
                                @forelse (collect(data_get($course, 'images', []))->filter(fn ($image) => data_get($image, 'path')) as $courseImage)
                                    <img class="record-thumbnail" src="{{ rtrim(config('services.adminsena_api.storage_url'), '/') . '/' . ltrim(data_get($courseImage, 'path'), '/') }}" alt="{{ data_get($courseImage, 'alt_text', 'Curso ' . data_get($course, 'course_number', '')) }}" loading="lazy">
                                @empty
                                    <span class="image-unavailable">Sin imagen</span>
                                @endforelse
                            </td>
                            <td>{{ data_get($course, 'program_name') ?: data_get($course, 'course_number', 'Sin nombre') }}</td>
                            <td>{{ $course['day'] ?? '' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3">No hay registros disponibles.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection