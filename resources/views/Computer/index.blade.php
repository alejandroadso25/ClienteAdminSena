@extends('Layouts.app')

@section('title', 'Computadores | AdminSena')

@section('content')
    <section class="resource-page container" aria-labelledby="computers-title">
        <div class="page-heading">
            <div>
                <p class="eyebrow">INVENTARIO</p>
                <h1 id="computers-title">Computadores</h1>
                <p>Equipos registrados en el sistema.</p>
            </div>
            <a class="primary-button" href="{{ route('computers.create') }}">Registrar computador</a>
        </div>

        {{-- Los registros reales se cargan desde el API; esta vista no consulta la base local. --}}
        <div id="computers-message" class="alert" role="status" aria-live="polite" hidden></div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Número</th>
                        <th scope="col">Marca</th>
                    </tr>
                </thead>
                <tbody id="computers-list"></tbody>
            </table>
        </div>
        <p id="computers-empty" class="empty-state" hidden>No hay computadores registrados.</p>
        <a class="text-button" href="{{ url('/') }}">Volver al inicio</a>
    </section>
@endsection

@push('scripts')
<script>
    // La petición GET lleva Basic Auth y nunca pasa por un endpoint POST del cliente.
    const apiBaseUrl = @json(rtrim(config('services.adminsena_api.base_url'), '/'));
    const authorization = sessionStorage.getItem('adminsena_basic_auth');
    const list = document.getElementById('computers-list');
    const emptyState = document.getElementById('computers-empty');
    const message = document.getElementById('computers-message');

    function showMessage(text, isError = false) {
        message.textContent = text;
        message.className = `alert ${isError ? 'alert-danger' : 'alert-success'}`;
        message.hidden = false;
    }

    function appendCell(row, text) {
        const cell = document.createElement('td');
        cell.textContent = text ?? '';
        row.append(cell);
        return cell;
    }

    async function loadComputers() {
        if (!authorization) {
            window.location.replace(@json(route('login')));
            return;
        }

        try {
            const response = await fetch(`${apiBaseUrl}/computers`, {
                headers: {
                    Accept: 'application/json',
                    Authorization: `Basic ${authorization}`,
                },
            });

            if (response.status === 401 || response.status === 403) {
                sessionStorage.removeItem('adminsena_basic_auth');
                window.location.replace(@json(route('login')));
                return;
            }

            if (!response.ok) throw new Error('No se pudieron cargar los computadores.');

            const computers = await response.json();
            list.replaceChildren();
            emptyState.hidden = computers.length > 0;

            for (const computer of computers) {
                const row = document.createElement('tr');
                const imageCell = document.createElement('td');

                if (computer.image?.path) {
                    const image = document.createElement('img');
                    const imagePath = computer.image.path.split('/').map(encodeURIComponent).join('/');
                    image.src = `${apiBaseUrl.replace(/\/v1\/?$/, '')}/storage/${imagePath}`;
                    image.alt = computer.image.alt_text ?? `Imagen del computador ${computer.number}`;
                    image.className = 'img-thumbnail computer-thumbnail';
                    imageCell.append(image);
                } else {
                    imageCell.textContent = 'Sin imagen';
                }

                row.append(imageCell);
                appendCell(row, computer.number);
                appendCell(row, computer.brand);
                list.append(row);
            }

            if (new URLSearchParams(window.location.search).has('created')) {
                showMessage('Computador registrado correctamente.');
            }
        } catch (error) {
            showMessage(error.message, true);
        }
    }

    loadComputers();
</script>
<style>
    /* Mantiene los estados vacíos y mensajes ocultos hasta que fetch los actualice. */
    #computers-message[hidden], #computers-empty[hidden] { display: none; }
    .computer-thumbnail { height: 3rem; object-fit: cover; width: 4rem; }
</style>
@endpush