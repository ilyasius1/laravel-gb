<?php

namespace App\Console;

use App\Services\CurrencyRatesParserService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
//         $schedule->command('app:fetch-rates')->everyFiveMinutes();
//         $schedule->call(fn() => (new CurrencyRatesParserService)->setLink('https://www.cbr-xml-daily.ru/daily_utf8.xml')->saveParseData())->everyFiveMinutes();
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
