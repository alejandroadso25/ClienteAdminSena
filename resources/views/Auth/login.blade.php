@extends('Layouts.app')

@section('title', 'Iniciar sesión | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="login-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">ACCESO ADMINISTRATIVO</p>
                <h1 id="login-title">Iniciar sesión</h1>
                <p>Ingresa con una cuenta que tenga rol administrador.</p>
            </div>
        </div>

        {{-- El formulario valida las credenciales con una petición GET protegida al API. --}}
        <div class="page">
            <form id="login-form">
                <div class="form-grid">
                    <label class="form-field full-width" for="login-email">
                        <span>Correo electrónico</span>
                        <input id="login-email" type="email" autocomplete="username" required>
                    </label>
                    <label class="form-field full-width" for="login-password">
                        <span>Contraseña</span>
                        <input id="login-password" type="password" autocomplete="current-password" required>
                    </label>
                </div>
                <p id="login-error" class="form-error" role="alert" hidden></p>
                <div class="modal-actions">
                    <button class="primary-button" id="login-submit" type="submit">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Verifica el acceso con auth.basic; no crea una sesión ni envía datos al backend del cliente.
    const apiBaseUrl = @json(rtrim(config('services.adminsena_api.base_url'), '/'));
    const loginForm = document.getElementById('login-form');
    const loginError = document.getElementById('login-error');
    const loginButton = document.getElementById('login-submit');

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        loginError.hidden = true;
        loginButton.disabled = true;

        const email = document.getElementById('login-email').value.trim();
        const password = document.getElementById('login-password').value;
        const credentialBytes = new TextEncoder().encode(`${email}:${password}`);
        let binaryCredentials = '';
        for (const byte of credentialBytes) binaryCredentials += String.fromCharCode(byte);
        const authorization = btoa(binaryCredentials);

        try {
            const response = await fetch(`${apiBaseUrl}/computers`, {
                headers: {
                    Accept: 'application/json',
                    Authorization: `Basic ${authorization}`,
                },
            });

            if (response.status === 401) throw new Error('Correo o contraseña incorrectos.');
            if (response.status === 403) throw new Error('La cuenta no tiene permisos de administrador.');
            if (!response.ok) throw new Error('No se pudo validar el acceso con el API.');

            // La credencial solo vive en sessionStorage y se elimina al cerrar sesión o la pestaña.
            sessionStorage.setItem('adminsena_basic_auth', authorization);
            window.location.assign(@json(route('computers.index')));
        } catch (error) {
            loginError.textContent = error.message;
            loginError.hidden = false;
        } finally {
            loginButton.disabled = false;
        }
    });
</script>
@endpush