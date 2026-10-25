<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TeacherController extends Controller
{
    // La vista Blade presenta los instructores obtenidos desde el API central.
    public function index(): View
    {
        // URL_SERVER_API permite cambiar la API; por defecto se consulta AdminSena v1.
        $url = env('URL_SERVER_API', 'http://api.adminsena.test/v1');
        $teachers = collect($this->fetchDataFromApi($url . '/teachers'));

        return view('Teacher.index', ['teachers' => $teachers, 'showForm' => false]);
    }

    public function create(): View
    {
        $url = env('URL_SERVER_API', 'http://api.adminsena.test/v1');

        return view('Teacher.index', [
            'teachers' => collect($this->fetchDataFromApi($url . '/teachers')),
            'areas' => collect($this->fetchDataFromApi($url . '/areas')),
            'trainingCenters' => collect($this->fetchDataFromApi($url . '/training-centers')),
            'showForm' => true,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API', 'http://api.adminsena.test/v1');
        // Solo se redirige al listado cuando la API confirma la creación sin error HTTP.
        Http::acceptJson()->timeout(10)->post($url . '/teachers', $request->all())->throw();

        return redirect()->route('teachers.index');
    }

    private function fetchDataFromApi(string $url): mixed
    {
        // Devuelve el JSON del endpoint y lanza una excepción ante respuestas HTTP fallidas.
        return Http::acceptJson()->timeout(10)->get($url)->throw()->json();
    }
}