<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ComputerController extends Controller
{
    // Consultar los computadores:
    public function index(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $computers = $this->fetchDataFromApi($url.'/computers');

        return view('Computers.index', [
            'computers' => $computers,
            'showForm' => false,
            'storageUrl' => $this->apiStorageUrl($url),
        ]);
    }

    // Mostrar el formulario de creación de computadores:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $computers = $this->fetchDataFromApi($url.'/computers');

        return view('Computers.create', [
            'computers' => $computers,
            'showForm' => true,
        ]);
    }

    // Crear computador:
    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        $this->sendRequestWithImages($request, $url.'/computers', 'POST', [
            'image' => false,
        ], $url.'/images', 'App\\Models\\Computer');

        return redirect()->route('computers.index');
    }

    // Consultar un computador específico:
    public function show($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $computer = $this->fetchDataFromApi($url.'/computers/'.$id);

        return view('Computers.show', compact('computer'));
    }

    // Mostrar el formulario para editar un computador específico:
    public function edit($id): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $computer = $this->fetchDataFromApi($url.'/computers/'.$id);

        return view('Computers.edit', compact('computer'));
    }

    // Actualizar computador:
    public function update(Request $request, $id): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        $this->sendRequestWithImages($request, $url.'/computers/'.$id, 'PUT', [
            'image' => false,
        ], $url.'/images', 'App\\Models\\Computer');

        return redirect()->route('computers.index');
    }

    // Eliminar computador:
    public function destroy($id): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::delete($url.'/computers/'.$id);

        return redirect()->route('computers.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}