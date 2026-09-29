<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TeacherController extends Controller
{
    // Consulta el endpoint de instructores y devuelve el JSON recibido.
    private function fetchDataFromApi(string $url): array
    {
        $response = Http::get($url);

        return $response->json() ?? [];
    }

    public function index(): View
    {
        $url = rtrim(config('services.adminsena_api.base_url'), '/');
        $teachers = $this->fetchDataFromApi($url . '/teachers');
        $title = 'Instructores';
        $description = 'Directorio de instructores registrados.';
        // Se conserva la columna aunque el instructor no tenga foto registrada.
        $columns = ['Imagen', 'Nombre', 'Correo'];

        // Entrega la lista y los datos de presentación a la vista.
        return view('Teacher.index', compact('teachers', 'title', 'description', 'columns'));
    }
}