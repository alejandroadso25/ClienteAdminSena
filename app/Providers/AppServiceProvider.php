<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Aquí se registran servicios y bindings personalizados antes de que la app arranque.
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Aquí se inicializan configuraciones globales, vistas compartidas o servicios del sistema.
    }
}
