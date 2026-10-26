@extends('Layouts.app')

@section('title', 'Crear computador | AdminSena')

@section('content')
    <section class="container py-4" aria-labelledby="computer-create-title">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-uppercase text-secondary mb-1">Inventario</p>
                <h1 id="computer-create-title">Crear computador</h1>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('computers.index') }}">Volver al listado</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        {{-- El formulario conserva los campos de computador definidos en el listado actual. --}}
        <form method="POST" action="{{ route('computers.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="computer-number">Número</label>
                <input class="form-control" id="computer-number" name="number" value="{{ old('number') }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="computer-brand">Marca</label>
                <input class="form-control" id="computer-brand" name="brand" value="{{ old('brand') }}" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="computer-image">Imagen</label>
                <input class="form-control" id="computer-image" name="image" type="file" accept="image/*">
            </div>
            <button class="btn btn-primary" type="submit">Crear computador</button>
            <a class="btn btn-outline-secondary" href="{{ route('computers.index') }}">Cancelar</a>
        </form>
    </section>
@endsection
