<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CourseController extends Controller
{
    // Consulta el endpoint de cursos y devuelve el JSON recibido.
    private function fetchDataFromApi(string $url): array
    {
        $response = Http::get($url);

        return $response->json() ?? [];
    }

    public function index(): View
    {
        $url = rtrim(config('services.adminsena_api.base_url'), '/');
        $courses = $this->fetchDataFromApi($url . '/courses');
        $title = 'Cursos';
        $description = 'Cursos registrados en el sistema.';
        // Cursos expone una lista de imágenes que puede estar vacía.
        $columns = ['Imágenes', 'Programa / ficha', 'Día'];

        // Entrega la lista y los datos de presentación a la vista.
        return view('Course.index', compact('courses', 'title', 'description', 'columns'));
    }
}