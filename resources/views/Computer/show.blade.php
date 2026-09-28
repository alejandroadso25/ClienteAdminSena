@extends('Layouts.app')

@section('title', 'Detalle del computador | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="computer-show-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">INVENTARIO</p>
                <h1 id="computer-show-title">Detalle del computador</h1>
            </div>
            <a class="secondary-button" href="{{ route('computers.index') }}">Volver al listado</a>
        </div>

        <div class="page">
            <dl class="detail-list">
                <div>
                    <dt>Número</dt>
                    <dd>PC-DEMO-001</dd>
                </div>
                <div>
                    <dt>Marca</dt>
                    <dd>Dell</dd>
                </div>
                <div>
                    <dt>Imagen</dt>
                    <dd>Sin imagen</dd>
                </div>
            </dl>
            <div class="modal-actions">
                <a class="primary-button" href="{{ route('computers.edit', 'demo') }}">Editar</a>
                <a class="secondary-button" href="{{ route('computers.index') }}">Volver</a>
            </div>
        </div>
    </section>
@endsection