@extends('Layouts.app')

@section('title', 'Inicio')

@section('content')
    <section class="container py-5">
        <div class="text-center mb-4">
            <span class="badge text-bg-success mb-2">ACTUALIDAD SENA</span>
            <h1 class="display-6 fw-bold">Noticias</h1>
        </div>

        <div class="row g-4">
            <article class="col-12 col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <span class="badge text-bg-primary mb-2">Convocatorias</span>
                        <h2 class="h5 card-title">Inscripciones abiertas</h2>
                        <p class="card-text">Participa en procesos del SENA.</p>
                        <a class="card-link" href="{{ url('/calls') }}">Ver convocatorias <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </article>

            <article class="col-12 col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <span class="badge text-bg-success mb-2">Ofertas</span>
                        <h2 class="h5 card-title">Formación disponible</h2>
                        <p class="card-text">Encuentra oportunidades de aprendizaje.</p>
                        <a class="card-link" href="{{ url('/offers') }}">Ver ofertas <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </article>

            <article class="col-12 col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <span class="badge text-bg-secondary mb-2">Comunidad</span>
                        <h2 class="h5 card-title">Únete a la red</h2>
                        <p class="card-text">Aprende, comparte y crece.</p>
                        <a class="card-link" href="{{ url('/apprentices') }}">Ver comunidad <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <section class="container pb-5">
        <div class="bg-light rounded-3 p-4 p-md-5">
            <p class="text-uppercase text-secondary fw-semibold mb-2">Conoce el SENA</p>
            <h2 class="h3">Una historia de oportunidades</h2>
            <p class="mb-4">Desde 1957, el SENA acompaña a los colombianos con formación profesional integral y herramientas para transformar sus proyectos de vida.</p>
            <a href="{{ url('/history') }}" class="btn btn-success">Conocer nuestra historia <span aria-hidden="true">→</span></a>
        </div>
    </section>
@endsection
