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

        return view('TrainingCenters.index', [
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

        return view('TrainingCenters.create', [
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

    // Consultar un centro de formación específico:
    public function show($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $trainingCenter = $this->fetchDataFromApi($url.'/training-centers/'.$id);

        return view('TrainingCenters.show', compact('trainingCenter'));
    }

    // Mostrar el formulario para editar un centro de formación específico:
    public function edit($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $trainingCenter = $this->fetchDataFromApi($url.'/training-centers/'.$id);

        return view('TrainingCenters.edit', compact('trainingCenter'));
    }

    // Actualizar centro de formación:
    public function update(Request $request, $id): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::put($url.'/training-centers/'.$id, $request->all());

        return redirect()->route('training-centers.index');
    }

    // Eliminar centro de formación:
    public function destroy($id): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::delete($url.'/training-centers/'.$id);

        return redirect()->route('training-centers.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}
