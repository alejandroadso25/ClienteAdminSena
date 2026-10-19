<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ApprenticeController extends Controller
{
    public function index(): View
    {
        $baseUrl = rtrim(config('services.adminsena_api.base_url'), '/');
        $apprentices = collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/apprentices')->throw()->json());

        return view('Apprentice.index', compact('apprentices'));
    }

    public function create(): View
    {
        $baseUrl = rtrim(config('services.adminsena_api.base_url'), '/');

        return view('Apprentice.create', [
            'courses' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/courses')->throw()->json()),
            'computers' => collect(Http::acceptJson()->timeout(10)->get($baseUrl . '/computers')->throw()->json()),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->createApiResource(
            $request,
            'apprentices',
            'apprentices.index',
            'Aprendiz creado correctamente.'
        );
    }
}