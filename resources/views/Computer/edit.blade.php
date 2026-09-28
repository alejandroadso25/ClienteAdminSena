@extends('Layouts.app')

@section('title', 'Editar computador | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="computer-edit-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">INVENTARIO</p>
                <h1 id="computer-edit-title">Editar computador</h1>
                <p>Vista previa del formulario de edición.</p>
            </div>
            <a class="secondary-button" href="{{ route('computers.index') }}">Volver al listado</a>
        </div>

        <div class="page">
            <div class="form-grid">
                <label class="form-field" for="computer-number">
                    <span>Número de computador</span>
                    <input id="computer-number" type="text" value="PC-DEMO-001" disabled>
                </label>
                <label class="form-field" for="computer-brand">
                    <span>Marca</span>
                    <input id="computer-brand" type="text" value="Dell" disabled>
                </label>
                <label class="form-field full-width" for="computer-image">
                    <span>Reemplazar imagen</span>
                    <input id="computer-image" type="file" accept="image/jpeg,image/png,image/webp" disabled>
                </label>
            </div>
            <div class="modal-actions">
                <button class="primary-button" type="button" disabled>Actualizar</button>
                <a class="secondary-button" href="{{ route('computers.index') }}">Cancelar</a>
            </div>
        </div>
    </section>
@endsection