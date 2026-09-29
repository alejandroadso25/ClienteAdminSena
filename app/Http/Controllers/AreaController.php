<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AreaController extends Controller
{
    // Consulta el endpoint de áreas y devuelve el JSON recibido.
    private function fetchDataFromApi(string $url): array
    {
        $response = Http::get($url);

        return $response->json() ?? [];
    }

    public function index(): View
    {
        $url = rtrim(config('services.adminsena_api.base_url'), '/');
        $areas = $this->fetchDataFromApi($url . '/areas');
        $title = 'Áreas';
        $description = 'Áreas de formación registradas.';
        $columns = ['Nombre'];

        // Entrega la lista y los datos de presentación a la vista.
        return view('Area.index', compact('areas', 'title', 'description', 'columns'));
    }
}