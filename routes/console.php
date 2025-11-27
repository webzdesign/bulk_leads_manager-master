<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\SiteSetting;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
$setting = SiteSetting::find(1);
 Schedule::command('lead:delete')->cron('* * */'.$setting->frequency_of_deleted_archives.' * *')->withoutOverlapping();
 Schedule::command('lead:send')->everyFiveMinutes()->withoutOverlapping();