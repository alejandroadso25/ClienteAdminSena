<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TrainingCenterController extends Controller
{
    // Las rutas web renderizan Blade y delegan las lecturas y altas al API central.
    public function index(): View
    {
        return $this->listing();
    }

    public function create(): View
    {
        return $this->listing(true);
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->createApiResource(
            $request,
            'training-centers',
            'training-centers.index',
            'Centro de formación creado correctamente.'
        );
    }

    private function listing(bool $showForm = false): View
    {
        // La creación reutiliza el listado para mantener juntos el formulario y la tabla.
        $url = rtrim(config('services.adminsena_api.base_url'), '/') . '/training-centers';

        return view('TrainingCenter.index', [
            'trainingCenters' => collect(Http::acceptJson()->timeout(10)->get($url)->throw()->json()),
            'showForm' => $showForm,
        ]);
    }
}
