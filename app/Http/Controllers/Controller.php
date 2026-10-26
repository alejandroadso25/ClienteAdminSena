<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function apiStorageUrl(string $apiUrl): string
    {
        // El API publica storage desde la raíz del dominio, no desde la ruta /v1.
        $apiRoot = preg_replace('#/v1/?$#', '', rtrim($apiUrl, '/'));

        return rtrim($apiRoot, '/').'/storage';
    }

    // Enviar datos e imágenes a la API conservando las peticiones normales si no hay archivos.
    protected function sendRequestWithImages(
        Request $request,
        string $url,
        string $method,
        array $imageFields,
        string $imagesUrl,
        string $imageableType
    ): Response
    {
        $validationRules = [];

        foreach ($imageFields as $field => $multiple) {
            if ($multiple) {
                $validationRules[$field] = 'sometimes|array';
                $validationRules[$field.'.*'] = 'image|max:5120';
            } else {
                $validationRules[$field] = 'sometimes|image|max:5120';
            }
        }

        $request->validate($validationRules);
        $data = $request->except(array_keys($imageFields));
        $hasImages = false;

        foreach ($imageFields as $field => $multiple) {
            if (! $request->hasFile($field)) {
                continue;
            }

            $files = $request->file($field);
            $files = is_array($files) ? $files : [$files];

            $hasImages = collect($files)->contains(fn ($file) => $file instanceof UploadedFile);
            if ($hasImages) {
                break;
            }
        }

        if (! $hasImages) {
            return $this->sendApiRequest($method, $url, $data);
        }

        // Primero se guarda el registro para obtener el ID que asociará el API a cada archivo.
        $response = $this->sendApiRequest($method, $url, $data);
        $response->throw();

        $recordId = $response->json('data.id') ?? $response->json('id');
        if (! $recordId) {
            throw new \UnexpectedValueException('La API no devolvió el ID del registro para asociar la imagen.');
        }

        $hasPrimaryImage = false;
        // El endpoint del API recibe un archivo por solicitud; solo el primero queda como principal.
        foreach ($imageFields as $field => $multiple) {
            if (! $request->hasFile($field)) {
                continue;
            }

            $files = $request->file($field);
            $files = is_array($files) ? $files : [$files];

            foreach ($files as $file) {
                if (! $file instanceof UploadedFile) {
                    continue;
                }

                Http::acceptJson()
                    ->attach('image', $file->getContent(), $file->getClientOriginalName())
                    ->post($imagesUrl, [
                        'imageable_type' => $imageableType,
                        'imageable_id' => $recordId,
                        'is_primary' => ! $hasPrimaryImage,
                    ])
                    ->throw();

                $hasPrimaryImage = true;
            }
        }

        return $response;
    }

    // Enviar la petición HTTP sin archivos usando el método indicado por el controlador.
    private function sendApiRequest(string $method, string $url, array $data): Response
    {
        return match ($method) {
            'POST' => Http::post($url, $data),
            'PUT' => Http::put($url, $data),
            default => throw new \InvalidArgumentException('Método HTTP no compatible para enviar imágenes.'),
        };
    }
}
