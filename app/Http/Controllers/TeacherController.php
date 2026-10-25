<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TeacherController extends Controller
{
    // Consultar los instructores:
    public function index(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $teachers = $this->fetchDataFromApi($url.'/teachers');

        return view('Teachers.index', [
            'teachers' => $teachers,
            'showForm' => false,
        ]);
    }

    // Mostrar el formulario de creación de instructores:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');

        return view('Teachers.index', [
            'teachers' => $this->fetchDataFromApi($url.'/teachers'),
            'areas' => $this->fetchDataFromApi($url.'/areas'),
            'trainingCenters' => $this->fetchDataFromApi($url.'/training-centers'),
            'showForm' => true,
        ]);
    }

    // Crear instructor:
    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::post($url.'/teachers', $request->all());

        return redirect()->route('teachers.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}
