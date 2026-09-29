<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TrainingCenterController extends Controller
{
    // Consulta el endpoint de centros y devuelve el JSON recibido.
    private function fetchDataFromApi(string $url): array
    {
        $response = Http::get($url);

        return $response->json() ?? [];
    }

    public function index(): View
    {
        $url = rtrim(config('services.adminsena_api.base_url'), '/');
        $trainingCenters = $this->fetchDataFromApi($url . '/training-centers');
        $title = 'Centros de formación';
        $description = 'Centros de formación registrados.';
        // Se conserva la columna aunque el centro no tenga imagen registrada.
        $columns = ['Imagen', 'Nombre', 'Ubicación'];

        // Entrega la lista y los datos de presentación a la vista.
        return view('TrainingCenter.index', compact('trainingCenters', 'title', 'description', 'columns'));
    }
}