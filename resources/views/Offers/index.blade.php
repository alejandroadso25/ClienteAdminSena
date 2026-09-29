@extends('Layouts.app')

@section('title', 'Ofertas | AdminSena')

@section('content')
    <section class="news-section container" aria-labelledby="offers-title">
        <div class="section-heading">
            <div>
                <p class="eyebrow text-success">PROGRAMAS DE FORMACIÓN</p>
                <h1 id="offers-title">Ofertas</h1>
            </div>
            <span class="section-line" aria-hidden="true"></span>
        </div>
        <div class="news-grid">
            <article class="news-card">
                <span class="news-date">OFERTA DE MUESTRA</span>
                <h2>Programa de formación</h2>
                <p>Vista previa de una oferta académica.</p>
                <button class="secondary-button" type="button" disabled>Más información no disponible</button>
            </article>
        </div>
    </section>
@endsection