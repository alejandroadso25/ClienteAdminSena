@extends('Layouts.app')

@section('title', 'Registrar computador | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="computer-create-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">INVENTARIO</p>
                <h1 id="computer-create-title">Registrar computador</h1>
                <p>Registra el equipo en el API de AdminSena.</p>
            </div>
            <a class="secondary-button" href="{{ route('computers.index') }}">Volver al listado</a>
        </div>

        {{-- El formulario envía JSON al API directamente; ClienteAdminSena mantiene rutas GET. --}}
        <div class="page">
            <form id="computer-form">
            <div class="form-grid">
                <label class="form-field" for="computer-number">
                    <span>Número de computador</span>
                    <input id="computer-number" name="number" type="text" placeholder="Ej. PC-001" maxlength="255" required>
                </label>
                <label class="form-field" for="computer-brand">
                    <span>Marca</span>
                    <input id="computer-brand" name="brand" type="text" placeholder="Marca del equipo" maxlength="255" required>
                </label>
            </div>
            <p id="computer-form-error" class="form-error" role="alert" hidden></p>
            <div class="modal-actions">
                <button class="primary-button" id="computer-submit" type="submit">Registrar</button>
                <a class="secondary-button" href="{{ route('computers.index') }}">Cancelar</a>
            </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // El navegador envía la operación al API; no hay ruta POST en ClienteAdminSena.
    const apiBaseUrl = @json(rtrim(config('services.adminsena_api.base_url'), '/'));
    const form = document.getElementById('computer-form');
    const errorMessage = document.getElementById('computer-form-error');
    const submitButton = document.getElementById('computer-submit');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        errorMessage.hidden = true;

        const authorization = sessionStorage.getItem('adminsena_basic_auth');
        if (!authorization) {
            window.location.assign(@json(route('login')));
            return;
        }

        submitButton.disabled = true;

        try {
            const response = await fetch(`${apiBaseUrl}/computers`, {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    Authorization: `Basic ${authorization}`,
                },
                body: JSON.stringify({
                    number: document.getElementById('computer-number').value.trim(),
                    brand: document.getElementById('computer-brand').value.trim(),
                }),
            });
            const payload = await response.json().catch(() => null);

            if (response.status === 401 || response.status === 403) {
                sessionStorage.removeItem('adminsena_basic_auth');
                window.location.assign(@json(route('login')));
                return;
            }

            if (!response.ok) {
                const validationMessage = Object.values(payload?.errors ?? {}).flat()[0];
                throw new Error(validationMessage ?? payload?.message ?? 'No se pudo registrar el computador.');
            }

            window.location.assign(`${@json(route('computers.index'))}?created=1`);
        } catch (error) {
            errorMessage.textContent = error.message;
            errorMessage.hidden = false;
        } finally {
            submitButton.disabled = false;
        }
    });
</script>
@endpush