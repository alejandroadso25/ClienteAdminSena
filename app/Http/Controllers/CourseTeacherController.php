<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CourseTeacherController extends Controller
{
    // Consultar las asignaciones de cursos e instructores:
    public function index(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $courseTeachers = $this->fetchDataFromApi($url.'/course-teachers');

        return view('CourseTeachers.index', [
            'courseTeachers' => $courseTeachers,
            'showForm' => false,
        ]);
    }

    // Mostrar el formulario de creación de asignaciones:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');

        return view('CourseTeachers.index', [
            'courseTeachers' => $this->fetchDataFromApi($url.'/course-teachers'),
            'courses' => $this->fetchDataFromApi($url.'/courses'),
            'teachers' => $this->fetchDataFromApi($url.'/teachers'),
            'showForm' => true,
        ]);
    }

    // Crear asignación:
    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::post($url.'/course-teachers', $request->all());

        return redirect()->route('course-teachers.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}