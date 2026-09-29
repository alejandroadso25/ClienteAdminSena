<section class="hero-carousel" data-carousel aria-label="Presentación del SENA">
    <div class="carousel-slides" aria-live="polite">
        <article class="carousel-slide carousel-slide--one is-active" aria-hidden="false">
            <div class="container carousel-content">
                <p class="eyebrow">ADMINISTRACIÓN ACADÉMICA</p>
                <h1>El SENA es de todos</h1>
                <p>Gestiona la formación, los instructores y los aprendices desde un solo lugar.</p>
            </div>
        </article>
        <article class="carousel-slide carousel-slide--two" aria-hidden="true">
            <div class="container carousel-content">
                <p class="eyebrow">GESTIÓN</p>
                <h2>Recursos y servicios</h2>
                <p>Consulta cursos, instructores, aprendices y los recursos de formación.</p>
            </div>
        </article>
        <article class="carousel-slide carousel-slide--three" aria-hidden="true">
            <div class="container carousel-content">
                <p class="eyebrow">FORMACIÓN</p>
                <h2>Oportunidades para crecer</h2>
                <p>Encuentra información para impulsar tu aprendizaje y tu futuro.</p>
            </div>
        </article>
    </div>

    <button class="carousel-control carousel-control--previous" type="button" data-carousel-previous aria-label="Diapositiva anterior">&#8592;</button>
    <button class="carousel-control carousel-control--next" type="button" data-carousel-next aria-label="Diapositiva siguiente">&#8594;</button>
    <div class="carousel-indicators" role="group" aria-label="Seleccionar diapositiva">
        <button type="button" class="is-active" data-carousel-indicator="0" aria-label="Mostrar diapositiva 1" aria-current="true"></button>
        <button type="button" data-carousel-indicator="1" aria-label="Mostrar diapositiva 2" aria-current="false"></button>
        <button type="button" data-carousel-indicator="2" aria-label="Mostrar diapositiva 3" aria-current="false"></button>
    </div>
</section>

@push('scripts')
<script>
    document.querySelectorAll('[data-carousel]').forEach((carousel) => {
        const slides = Array.from(carousel.querySelectorAll('.carousel-slide'));
        const indicators = Array.from(carousel.querySelectorAll('[data-carousel-indicator]'));
        let activeIndex = 0;
        let timer;
        let isHovered = false;
        let isFocused = false;

        const showSlide = (index) => {
            activeIndex = (index + slides.length) % slides.length;
            slides.forEach((slide, slideIndex) => {
                const isActive = slideIndex === activeIndex;
                slide.classList.toggle('is-active', isActive);
                slide.setAttribute('aria-hidden', String(!isActive));
                indicators[slideIndex].classList.toggle('is-active', isActive);
                indicators[slideIndex].setAttribute('aria-current', String(isActive));
            });
        };

        const stopTimer = () => {
            window.clearInterval(timer);
            timer = undefined;
        };

        // El avance automático se pausa mientras el usuario apunta o navega con teclado.
        const startTimer = () => {
            stopTimer();
            if (!isHovered && !isFocused && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                timer = window.setInterval(() => showSlide(activeIndex + 1), 6000);
            }
        };

        carousel.querySelector('[data-carousel-previous]').addEventListener('click', () => showSlide(activeIndex - 1));
        carousel.querySelector('[data-carousel-next]').addEventListener('click', () => showSlide(activeIndex + 1));
        indicators.forEach((indicator, index) => indicator.addEventListener('click', () => showSlide(index)));
        carousel.addEventListener('mouseenter', () => {
            isHovered = true;
            stopTimer();
        });
        carousel.addEventListener('mouseleave', () => {
            isHovered = false;
            startTimer();
        });
        carousel.addEventListener('focusin', () => {
            isFocused = true;
            stopTimer();
        });
        carousel.addEventListener('focusout', (event) => {
            isFocused = carousel.contains(event.relatedTarget);
            startTimer();
        });
        startTimer();
    });
</script>
@endpush
