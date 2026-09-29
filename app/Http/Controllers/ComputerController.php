<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ComputerController extends Controller
{
    // Consulta el endpoint de computadores y devuelve el JSON recibido.
    private function fetchDataFromApi(string $url): array
    {
        $response = Http::get($url);

        return $response->json() ?? [];
    }

    public function index(): View
    {
        $url = rtrim(config('services.adminsena_api.base_url'), '/');
        $computers = $this->fetchDataFromApi($url . '/computers');
        $title = 'Computadores';
        $description = 'Equipos registrados en el sistema.';
        $columns = ['Imagen', 'Número', 'Marca'];

        // Entrega la lista y los datos de presentación a la vista.
        return view('Computer.index', compact('computers', 'title', 'description', 'columns'));
    }
}