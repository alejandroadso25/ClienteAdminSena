<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AreaController extends Controller
{
    // Consultar las áreas:
    public function index(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $areas = $this->fetchDataFromApi($url.'/areas');

        return view('Area.index', [
            'areas' => $areas,
            'showForm' => false,
        ]);
    }

    // Mostrar el formulario de creación de áreas:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $areas = $this->fetchDataFromApi($url.'/areas');

        return view('Area.index', [
            'areas' => $areas,
            'showForm' => true,
        ]);
    }

    // Crear área:
    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::post($url.'/areas', $request->all());

        return redirect()->route('areas.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}
