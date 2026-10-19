<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function createApiResource(
        Request $request,
        string $endpoint,
        string $indexRoute,
        string $successMessage
    ): RedirectResponse {
        $url = rtrim(config('services.adminsena_api.base_url'), '/') . '/' . ltrim($endpoint, '/');
        $response = Http::acceptJson()
            ->timeout(10)
            ->post($url, $request->except(['_token', '_method']));

        if ($response->unprocessableEntity()) {
            return back()
                ->withErrors($response->json('errors') ?? ['api' => 'La API rechazó los datos.'])
                ->withInput();
        }

        $response->throw();

        return redirect()
            ->route($indexRoute)
            ->with('status', $response->json('message') ?? $successMessage);
    }
}
