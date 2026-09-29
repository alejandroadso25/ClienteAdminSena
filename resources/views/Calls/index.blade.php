@extends('Layouts.app')

@section('title', 'Convocatorias | AdminSena')

@section('content')
    <section class="news-section container" aria-labelledby="calls-title">
        <div class="section-heading">
            <div>
                <p class="eyebrow text-success">OPORTUNIDADES DE FORMACIÓN</p>
                <h1 id="calls-title">Convocatorias</h1>
            </div>
            <span class="section-line" aria-hidden="true"></span>
        </div>
        <div class="news-grid">
            <article class="news-card">
                <span class="news-date">CONVOCATORIA DE MUESTRA</span>
                <h2>Programa de formación</h2>
                <p>Vista previa de una convocatoria disponible.</p>
                <button class="secondary-button" type="button" disabled>Inscripción no disponible</button>
            </article>
        </div>
    </section>
@endsection