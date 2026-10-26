@extends('Layouts.app')

@section('title', 'Detalle del computador | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="computer-show-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <h1 id="computer-show-title">Detalle del computador</h1>
            <div class="d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('computers.edit', $computer['id']) }}">Editar</a>
                <a class="btn btn-outline-secondary" href="{{ route('computers.index') }}">Volver al listado</a>
            </div>
        </div>
        <dl class="row">
            <dt class="col-sm-3">Número</dt><dd class="col-sm-9">{{ $computer['number'] ?? '' }}</dd>
            <dt class="col-sm-3">Marca</dt><dd class="col-sm-9">{{ $computer['brand'] ?? '' }}</dd>
        </dl>
    </section>
@endsection
