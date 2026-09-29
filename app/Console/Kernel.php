<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Aquí se definen tareas programadas del sistema, como respaldo, limpieza o avisos automáticos.
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        // Carga comandos personalizados del proyecto para que queden disponibles en artisan.
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
