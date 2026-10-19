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
        $url = rtrim(config('services.adminsena_api.base_url'), '/') . '/teachers';
        $teachers = collect(Http::acceptJson()->timeout(10)->get($url)->throw()->json());

        return view('Teacher.index', ['teachers' => $teachers, 'showForm' => false]);
    }

    public function create(): View
    {
        $baseUrl = rtrim(config('services.adminsena_api.base_url'), '/');

        return view('Teacher.index', [
            'teachers' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/teachers')->throw()->json()),
            'areas' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/areas')->throw()->json()),
            'trainingCenters' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/training-centers')->throw()->json()),
            'showForm' => true,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->createApiResource($request, 'teachers', 'teachers.index', 'Instructor creado correctamente.');
    }
}