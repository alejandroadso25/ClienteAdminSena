@extends('Layouts.app')

@section('title', 'AdminSena | Inicio')

@section('content')
    {{-- El carrusel reemplaza el hero estático y usa controles JavaScript propios. --}}
    @include('Includes.carousel')

    <section class="news-section container">
        <div class="section-header">
            <span class="section-tag">ACTUALIDAD SENA</span>
            <h2>NOTICIAS</h2>
        </div>

        <div class="news-grid">
            <article class="news-card card-white left-card">
                <span class="news-label">CONVOCATORIAS</span>
                <h3>INSCRIPCIONES ABIERTAS</h3>
                <p>Participa en procesos del SENA.</p>
                <a href="{{ url('/calls') }}">Ver convocatorias <span>→</span></a>
            </article>

            <article class="news-card card-white middle-card">
                <span class="news-label">OFERTAS</span>
                <h3>FORMACIÓN DISPONIBLE</h3>
                <p>Encuentra oportunidades de aprendizaje.</p>
                <a href="{{ url('/offers') }}">Ver ofertas <span>→</span></a>
            </article>

            <article class="news-card card-white right-card">
                <span class="news-label">COMUNIDAD</span>
                <h3>ÚNETE A LA RED</h3>
                <p>Aprende, comparte y crece.</p>
                <a href="{{ url('/apprentices') }}">Ver comunidad <span>→</span></a>
            </article>
        </div>
    </section>

    {{-- El home React termina con este teaser antes del footer institucional. --}}
    <section class="story-teaser container">
        <p class="eyebrow">CONOCE EL SENA</p>
        <h2>Una historia de oportunidades</h2>
        <p>Desde 1957, el SENA acompaña a los colombianos con formación profesional integral y herramientas para transformar sus proyectos de vida.</p>
        <a href="{{ url('/history') }}" class="primary-button">Conocer nuestra historia <span>→</span></a>
    </section>
@endsection
