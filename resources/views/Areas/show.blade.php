@extends('Layouts.app')

@section('title', 'Detalle del área | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="area-show-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <h1 id="area-show-title">Detalle del área</h1>
            <div class="d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('areas.edit', $area['id']) }}">Editar</a>
                <a class="btn btn-outline-secondary" href="{{ route('areas.index') }}">Volver al listado</a>
            </div>
        </div>
        <dl class="row">
            <dt class="col-sm-3">Nombre</dt><dd class="col-sm-9">{{ $area['name'] ?? '' }}</dd>
        </dl>
    </section>
@endsection
