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

        return view('Courses.index', [
            'courses' => $courses,
            'showForm' => false,
            'storageUrl' => $this->apiStorageUrl($url),
        ]);
    }

    // Mostrar el formulario de creación de cursos:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');

        return view('Courses.create', [
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
        $this->sendRequestWithImages($request, $url.'/courses', 'POST', [
            'images' => true,
        ], $url.'/images', 'App\\Models\\Course');

        return redirect()->route('courses.index');
    }

    // Consultar un curso específico:
    public function show($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $course = $this->fetchDataFromApi($url.'/courses/'.$id);

        return view('Courses.show', compact('course'));
    }

    // Mostrar el formulario para editar un curso específico:
    public function edit($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');

        return view('Courses.edit', [
            'course' => $this->fetchDataFromApi($url.'/courses/'.$id),
            'areas' => $this->fetchDataFromApi($url.'/areas'),
            'trainingCenters' => $this->fetchDataFromApi($url.'/training-centers'),
        ]);
    }

    // Actualizar curso:
    public function update(Request $request, $id): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        $this->sendRequestWithImages($request, $url.'/courses/'.$id, 'PUT', [
            'images' => true,
        ], $url.'/images', 'App\\Models\\Course');

        return redirect()->route('courses.index');
    }

    // Eliminar curso:
    public function destroy($id): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::delete($url.'/courses/'.$id);

        return redirect()->route('courses.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}