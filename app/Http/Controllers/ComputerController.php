<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ComputerController extends Controller
{
    // Las rutas web renderizan Blade y delegan las lecturas y altas al API central.
    public function index(): View
    {
        return $this->listing();
    }

    public function create(): View
    {
        return $this->listing(true);
    }

    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API', 'http://api.adminsena.test/v1');
        // Solo se redirige al listado cuando la API confirma la creación sin error HTTP.
        Http::acceptJson()->timeout(10)->post($url . '/computers', $request->all())->throw();

        return redirect()->route('computers.index');
    }

    private function listing(bool $showForm = false): View
    {
        // La creación reutiliza el listado para mantener juntos el formulario y la tabla.
        $url = env('URL_SERVER_API', 'http://api.adminsena.test/v1');

        return view('Computer.index', [
            'computers' => collect($this->fetchDataFromApi($url . '/computers')),
            'showForm' => $showForm,
        ]);
    }

    private function fetchDataFromApi(string $url): mixed
    {
        // Devuelve el JSON del endpoint y lanza una excepción ante respuestas HTTP fallidas.
        return Http::acceptJson()->timeout(10)->get($url)->throw()->json();
    }
}
