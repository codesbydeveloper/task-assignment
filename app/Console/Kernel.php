<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('system:daily-cleanup')
            ->dailyAt('02:00')
            ->withoutOverlapping(30)
            ->onOneServer()
            ->runInBackground();

        $schedule->command('reports:generate-daily')
            ->dailyAt('02:30')
            ->withoutOverlapping(60)
            ->onOneServer()
            ->runInBackground();

        $schedule->command('system:health-check')
            ->everyTenMinutes()
            ->withoutOverlapping(10)
            ->onOneServer()
            ->runInBackground();

        $schedule->command('notifications:dispatch-pending')
            ->everyFiveMinutes()
            ->withoutOverlapping(5)
            ->onOneServer()
            ->runInBackground();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
