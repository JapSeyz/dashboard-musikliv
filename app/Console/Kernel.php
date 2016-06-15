<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Components\Notification\FetchNotifications::class,
        \App\Components\GoogleCalendar\FetchGoogleCalendarEvents::class,
        \App\Components\LastFm\FetchCurrentTrack::class,
        \App\Components\Packagist\FetchTotals::class,
        \App\Components\RainForecast\FetchRainForecast::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('dashboard:lastfm')->everyMinute();
        $schedule->command('dashboard:calendar')->everyFiveMinutes();
        $schedule->command('dashboard:packagist')->everyMinute();
        $schedule->command('dashboard:notification')->everyFiveMinute();
        $schedule->command('dashboard:rain')->everyFiveMinutes();
    }
}
