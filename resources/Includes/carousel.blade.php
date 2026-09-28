{{-- Carrusel Bootstrap con las cinco imágenes disponibles en public/assets. --}}
<section id="senaCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" aria-label="Destacados de AdminSena">
    {{-- Los indicadores permiten saltar directamente a cada imagen. --}}
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Mostrar primera imagen"></button>
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="1" aria-label="Mostrar segunda imagen"></button>
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="2" aria-label="Mostrar tercera imagen"></button>
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="3" aria-label="Mostrar cuarta imagen"></button>
        <button type="button" data-bs-target="#senaCarousel" data-bs-slide-to="4" aria-label="Mostrar quinta imagen"></button>
    </div>

    {{-- Cada diapositiva presenta un módulo del sistema y su enlace correspondiente. --}}
    <div class="carousel-inner">
        <div class="carousel-item active carousel-image carousel-image-1">
            <div class="container hero-content">
                <div class="hero-copy">
                    <p class="eyebrow">ADMINISTRACIÓN ACADÉMICA</p>
                    <h1>El SENA<br><strong>es de todos</strong></h1>
                    <p class="hero-text">Gestiona la formación, los instructores y los aprendices desde un solo lugar.</p>
                </div>
            </div>
        </div>

        <div class="carousel-item carousel-image carousel-image-2">
            <div class="container hero-content">
                <div class="hero-copy">
                    <p class="eyebrow">FORMACIÓN PARA EL FUTURO</p>
                    <h1>Aprende y<br><strong>crece</strong></h1>
                    <p class="hero-text">Consulta los cursos y organiza la oferta académica de tu centro.</p>
                </div>
            </div>
        </div>

        <div class="carousel-item carousel-image carousel-image-3">
            <div class="container hero-content">
                <div class="hero-copy">
                    <p class="eyebrow">COMUNIDAD SENA</p>
                    <h1>Personas que<br><strong>transforman</strong></h1>
                    <p class="hero-text">Mantén actualizada la información de instructores y aprendices.</p>
                </div>
            </div>
        </div>

        <div class="carousel-item carousel-image carousel-image-4">
            <div class="container hero-content"><div class="hero-copy"><p class="eyebrow">RECURSOS DISPONIBLES</p><h1>Conecta tus<br><strong>recursos</strong></h1><p class="hero-text">Administra computadores y centros de formación desde un mismo panel.</p></div></div>
        </div>

        <div class="carousel-item carousel-image carousel-image-5">
            <div class="container hero-content"><div class="hero-copy"><p class="eyebrow">GESTIÓN SENCILLA</p><h1>Todo en<br><strong>un lugar</strong></h1><p class="hero-text">Accede rápidamente a cada módulo de AdminSena.</p></div></div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#senaCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#senaCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</section>