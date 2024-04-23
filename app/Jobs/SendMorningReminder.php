<?php

namespace App\Jobs;

use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Notifications\FresqueApplicationReminderMorning;
use App\Notifications\TaskSchedulingExecuted;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendMorningReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $count;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->count = 0;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $applications = FresqueApplication::whereIn('state', ['registered', 'confirmed_presence'])->whereHas('fresque', function ($query) {
            $query->where('date', Carbon::now()->format('Y-m-d'));
        })->get();

        $applications->each(function ($application) {
            $application->notify(new FresqueApplicationReminderMorning());
            $this->count++;
        });

        if ($this->count > 0) {
            Notification::route('slack', config('services.slack.notifications.channel'))
                ->notify(new TaskSchedulingExecuted('[J0] La Fresque du Bénévolat, c’est aujourd’hui ✌🏻', $this->count));
        }
    }
}
