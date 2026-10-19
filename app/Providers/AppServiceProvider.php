<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        // Permite incluir parciales compartidos que viven en resources/Includes.
        View::addNamespace('includes', resource_path('Includes'));
    }
}
