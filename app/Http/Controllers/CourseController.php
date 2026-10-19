<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CourseController extends Controller
{
    // La vista Blade presenta los datos obtenidos desde el endpoint de cursos del backend.
    public function index(): View
    {
        $url = rtrim(config('services.adminsena_api.base_url'), '/') . '/courses';
        $courses = collect(Http::acceptJson()->timeout(10)->get($url)->throw()->json());

        return view('Course.index', ['courses' => $courses, 'showForm' => false]);
    }

    public function create(): View
    {
        $baseUrl = rtrim(config('services.adminsena_api.base_url'), '/');

        return view('Course.index', [
            'courses' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/courses')->throw()->json()),
            'areas' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/areas')->throw()->json()),
            'trainingCenters' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/training-centers')->throw()->json()),
            'showForm' => true,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->createApiResource($request, 'courses', 'courses.index', 'Curso creado correctamente.');
    }
}