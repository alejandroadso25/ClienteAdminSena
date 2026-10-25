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

        return view('Computer.index', [
            'computers' => $computers,
            'showForm' => false,
        ]);
    }

    // Mostrar el formulario de creación de computadores:
    public function create(): View
    {
        // Variable de SERVER API:
        $url = env('URL_SERVER_API');
        $computers = $this->fetchDataFromApi($url.'/computers');

        return view('Computer.index', [
            'computers' => $computers,
            'showForm' => true,
        ]);
    }

    // Crear computador:
    public function store(Request $request): RedirectResponse
    {
        $url = env('URL_SERVER_API');
        Http::post($url.'/computers', $request->all());

        return redirect()->route('computers.index');
    }

    // Consultar a la API y devolver la respuesta en formato JSON:
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }
}
