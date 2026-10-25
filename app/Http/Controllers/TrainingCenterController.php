<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TrainingCenterController extends Controller
{
    // Consultar los centros de formación:
    public function index(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $trainingCenters = $this->fetchDataFromApi($url.'/training-centers');

        return view('TrainingCenter.index', [
            'trainingCenters' => $trainingCenters,
            'showForm' => false,
        ]);
    }

    // Mostrar el formulario de creación de centros de formación:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $trainingCenters = $this->fetchDataFromApi($url.'/training-centers');

        return view('TrainingCenter.index', [
            'trainingCenters' => $trainingCenters,
            'showForm' => true,
        ]);
    }

    // Crear centro de formación:
    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::post($url.'/training-centers', $request->all());

        return redirect()->route('training-centers.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}
