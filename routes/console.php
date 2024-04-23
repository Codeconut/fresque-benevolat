<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();


Schedule::job(new App\Jobs\SendXDaysReminderToFresqueApplications)->dailyAt('13:00')->environments(['production']);
Schedule::job(new App\Jobs\SendMorningReminderToFresqueApplications)->dailyAt('07:30')->environments(['production']);
Schedule::job(new App\Jobs\SendJ3Feedback)->dailyAt('09:00')->environments(['production']);
Schedule::job(new App\Jobs\SendS3Feedback)->dailyAt('09:30')->environments(['production']);
Schedule::job(new App\Jobs\SendS6Feedback)->dailyAt('10:00')->environments(['production']);
Schedule::job(new App\Jobs\SendS12Feedback)->dailyAt('10:30')->environments(['production']);
