@extends('Layouts.app')

@section('title', 'Detalle del centro de formación | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="training-center-show-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <h1 id="training-center-show-title">Detalle del centro de formación</h1>
            <div class="d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('training-centers.edit', $trainingCenter['id']) }}">Editar</a>
                <a class="btn btn-outline-secondary" href="{{ route('training-centers.index') }}">Volver al listado</a>
            </div>
        </div>
        <dl class="row">
            <dt class="col-sm-3">Nombre</dt><dd class="col-sm-9">{{ $trainingCenter['name'] ?? '' }}</dd>
            <dt class="col-sm-3">Ubicación</dt><dd class="col-sm-9">{{ $trainingCenter['location'] ?? '' }}</dd>
        </dl>
    </section>
@endsection
