<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CourseTeacherController extends Controller
{
    // Consulta el endpoint de asignaciones y devuelve el JSON recibido.
    private function fetchDataFromApi(string $url): array
    {
        $response = Http::get($url);

        return $response->json() ?? [];
    }

    public function index(): View
    {
        $url = rtrim(config('services.adminsena_api.base_url'), '/');
        $courseTeachers = $this->fetchDataFromApi($url . '/course-teachers');
        $title = 'Asignaciones curso-instructor';
        $description = 'Asignaciones académicas registradas.';
        $columns = ['Curso', 'Instructor'];

        // Entrega las asignaciones y los datos de presentación a la vista.
        return view('CourseTeacher.index', compact('courseTeachers', 'title', 'description', 'columns'));
    }
}