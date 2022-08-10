<?php

namespace App\Console;

use App\Models\SiteSetting;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $setting = SiteSetting::find(1);
        $schedule->command('lead:delete')->cron('* * */'.$setting->frequency_of_deleted_archives.' * *')->withoutOverlapping();
        $schedule->command('lead:send')->everyFiveMinutes()->withoutOverlapping();
        // $schedule->command('test:mail')->everyMinute()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
