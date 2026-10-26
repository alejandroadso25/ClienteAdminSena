@extends('Layouts.app')

@section('title', 'Detalle del aprendiz | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="apprentice-show-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">REGISTROS</p>
                <h1 id="apprentice-show-title">Detalle del aprendiz</h1>
            </div>
            <div class="modal-actions">
                <a class="primary-button" href="{{ route('apprentices.edit', $apprentice['id']) }}">Editar</a>
                <a class="secondary-button" href="{{ route('apprentices.index') }}">Volver al listado</a>
            </div>
        </div>

        {{-- El detalle presenta los campos que ya maneja el formulario de aprendices. --}}
        <div class="page">
            <dl class="row">
                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9">{{ $apprentice['name'] ?? '' }}</dd>

                <dt class="col-sm-3">Correo</dt>
                <dd class="col-sm-9">{{ $apprentice['email'] ?? '' }}</dd>

                <dt class="col-sm-3">Celular</dt>
                <dd class="col-sm-9">{{ $apprentice['cell_number'] ?? 'Sin celular registrado' }}</dd>

                <dt class="col-sm-3">Curso</dt>
                <dd class="col-sm-9">{{ data_get($apprentice, 'course.course_number', data_get($apprentice, 'course_id', '')) }}</dd>

                <dt class="col-sm-3">Computador</dt>
                <dd class="col-sm-9">{{ data_get($apprentice, 'computer.number', data_get($apprentice, 'computer_id', 'Sin computador asignado')) }}</dd>
            </dl>
        </div>
    </section>
@endsection
