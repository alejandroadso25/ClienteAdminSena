<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ApprenticeController extends Controller
{
    // Consultar los aprendices:
    public function index(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $apprentices = $this->fetchDataFromApi($url.'/apprentices');

        return view('Apprentices.index', compact('apprentices'));
    }

    // Mostrar el formulario de creación de aprendices:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');

        return view('Apprentices.create', [
            'courses' => $this->fetchDataFromApi($url.'/courses'),
            'computers' => $this->fetchDataFromApi($url.'/computers'),
        ]);
    }

    // Crear aprendiz:
    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');
        Http::post($url.'/apprentices', $request->all());

        return redirect()->route('apprentices.index');
    }

    // Consultar un aprendiz específico:
    public function show($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $apprentice = $this->fetchDataFromApi($url.'/apprentices/'.$id);

        return view('Apprentices.show', compact('apprentice'));
    }

    // Mostrar el formulario para editar un aprendiz específico:
    public function edit($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');

        return view('Apprentices.edit', [
            'apprentice' => $this->fetchDataFromApi($url.'/apprentices/'.$id),
            'courses' => $this->fetchDataFromApi($url.'/courses'),
            'computers' => $this->fetchDataFromApi($url.'/computers'),
        ]);
    }

    // Actualizar aprendiz:
    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');
        Http::put($url.'/apprentices/'.$id, $request->all());

        return redirect()->route('apprentices.index');
    }

    // Eliminar aprendiz:
    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url.'/apprentices/'.$id);

        return redirect()->route('apprentices.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }
}