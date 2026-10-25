<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ApprenticeController extends Controller
{
    public function index(): View
    {
        // URL_SERVER_API permite cambiar la API; por defecto se consulta AdminSena v1.
        $url = env('URL_SERVER_API', 'http://api.adminsena.test/v1');
        $apprentices = collect($this->fetchDataFromApi($url . '/apprentices'));

        return view('Apprentice.index', compact('apprentices'));
    }

    public function create(): View
    {
        $url = env('URL_SERVER_API', 'http://api.adminsena.test/v1');

        return view('Apprentice.create', [
            'courses' => collect($this->fetchDataFromApi($url . '/courses')),
            'computers' => collect($this->fetchDataFromApi($url . '/computers')),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API', 'http://api.adminsena.test/v1');
        // El error HTTP se propaga para no redirigir como si el registro se hubiera creado.
        Http::acceptJson()->timeout(10)->post($url . '/apprentices', $request->all())->throw();

        return redirect()->route('apprentices.index');
    }

    private function fetchDataFromApi(string $url): mixed
    {
        // Devuelve el JSON del endpoint y lanza una excepción ante respuestas HTTP fallidas.
        return Http::acceptJson()->timeout(10)->get($url)->throw()->json();
    }
}