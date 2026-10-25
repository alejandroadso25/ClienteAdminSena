<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CourseController extends Controller
{
    // Consultar los cursos:
    public function index(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $courses = $this->fetchDataFromApi($url.'/courses');

        return view('Course.index', [
            'courses' => $courses,
            'showForm' => false,
        ]);
    }

    // Mostrar el formulario de creación de cursos:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');

        return view('Course.index', [
            'courses' => $this->fetchDataFromApi($url.'/courses'),
            'areas' => $this->fetchDataFromApi($url.'/areas'),
            'trainingCenters' => $this->fetchDataFromApi($url.'/training-centers'),
            'showForm' => true,
        ]);
    }

    // Crear curso:
    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::post($url.'/courses', $request->all());

        return redirect()->route('courses.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}
