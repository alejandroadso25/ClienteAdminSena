@extends('Layouts.app')

@section('title', 'Historia del SENA | AdminSena')

@section('content')
    <div class="history-page">
        <div class="history-heading">
            <p class="eyebrow text-success">CONOCE NUESTRA INSTITUCIÓN</p>
            <h1>Historia del SENA</h1>
            <p>Una institución colombiana al servicio de la formación y el desarrollo social.</p>
        </div>

        <article class="history-content">
            <div>
                <span class="history-year">1957</span>
                <h2>El comienzo de una gran misión</h2>
                <p>El Servicio Nacional de Aprendizaje nació con la misión de brindar formación profesional a trabajadores, jóvenes y adultos del país.</p>
            </div>
            <img src="{{ asset('storage/images/Sena%201957.jpg') }}" alt="SENA en 1957">
        </article>

        <article class="history-content history-content-reverse">
            <div>
                <span class="history-year">HOY</span>
                <h2>Formación que transforma</h2>
                <p>El SENA continúa ofreciendo formación y oportunidades para el desarrollo social y productivo de Colombia.</p>
            </div>
            <img src="{{ asset('storage/images/Sena%20hoy.jpg') }}" alt="SENA en la actualidad">
        </article>
    </div>
@endsection