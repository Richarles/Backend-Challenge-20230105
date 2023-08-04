<?php

namespace App\Console;

use App\Console\Commands\AddProducts;
use App\Jobs\ProcessSaveProductFile;
use DateInterval;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $logSchedule = Log::build([
             'driver' => 'single',
             'path' => storage_path('app/public/logs/schedule.log'),
         ]);

        $schedule->command(AddProducts::class)
                ->everyFiveMinutes()
                ->before(function () use ($logSchedule) {
                        $logSchedule->info('Ultimo Horario do Cron : '.date("Y-m-d H:i:s"));
                });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}