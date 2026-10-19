<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CourseTeacherController extends Controller
{
    // La vista Blade presenta las asignaciones obtenidas desde el API central.
    public function index(): View
    {
        $url = rtrim(config('services.adminsena_api.base_url'), '/') . '/course-teachers';
        $courseTeachers = collect(Http::acceptJson()->timeout(10)->get($url)->throw()->json());

        return view('CourseTeacher.index', ['courseTeachers' => $courseTeachers, 'showForm' => false]);
    }

    public function create(): View
    {
        $baseUrl = rtrim(config('services.adminsena_api.base_url'), '/');

        return view('CourseTeacher.index', [
            'courseTeachers' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/course-teachers')->throw()->json()),
            'courses' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/courses')->throw()->json()),
            'teachers' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/teachers')->throw()->json()),
            'showForm' => true,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->createApiResource(
            $request,
            'course-teachers',
            'course-teachers.index',
            'Asignación creada correctamente.'
        );
    }
}