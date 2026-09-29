<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ApprenticeController extends Controller
{
    // Consulta el endpoint de aprendices y devuelve el JSON recibido.
    private function fetchDataFromApi(string $url): array
    {
        $response = Http::get($url);

        return $response->json() ?? [];
    }

    public function index(): View
    {
        $url = rtrim(config('services.adminsena_api.base_url'), '/');
        $apprentices = $this->fetchDataFromApi($url . '/apprentices');
        $title = 'Aprendices';
        $description = 'Directorio de aprendices registrados.';
        // La columna queda disponible aunque el aprendiz todavía no tenga foto.
        $columns = ['Imagen', 'Nombre', 'Correo', 'Celular'];

        // Entrega la lista y los datos de presentación a la vista.
        return view('Apprentice.index', compact('apprentices', 'title', 'description', 'columns'));
    }
}