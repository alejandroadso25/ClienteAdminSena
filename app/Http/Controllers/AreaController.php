<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AreaController extends Controller
{
    // Consultar las áreas:
    public function index(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $areas = $this->fetchDataFromApi($url.'/areas');

        return view('Areas.index', [
            'areas' => $areas,
            'showForm' => false,
        ]);
    }

    // Mostrar el formulario de creación de áreas:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $areas = $this->fetchDataFromApi($url.'/areas');

        return view('Areas.index', [
            'areas' => $areas,
            'showForm' => true,
        ]);
    }

    // Crear área:
    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::post($url.'/areas', $request->all());

        return redirect()->route('areas.index');
    }

    // Consultar un área específico:
    public function show($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $area = $this->fetchDataFromApi($url.'/areas/'.$id);

        return view('Areas.show', compact('area'));
    }

    // Mostrar el formulario para editar un área específica:
    public function edit($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $area = $this->fetchDataFromApi($url.'/areas/'.$id);

        return view('Areas.edit', compact('area'));
    }

    // Actualizar área:
    public function update(Request $request, $id): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::put($url.'/areas/'.$id, $request->all());

        return redirect()->route('areas.index');
    }

    // Eliminar área:
    public function destroy($id): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::delete($url.'/areas/'.$id);

        return redirect()->route('areas.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}