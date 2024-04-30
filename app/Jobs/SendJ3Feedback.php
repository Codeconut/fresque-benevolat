<?php

namespace App\Jobs;

use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Notifications\FresqueApplicationFeedbackJ3;
use App\Notifications\FresqueApplicationReminderXDays;
use App\Notifications\TaskSchedulingExecuted;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendJ3Feedback implements ShouldQueue
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
        $applications = FresqueApplication::where('state', 'validated')
            ->whereHas('fresque', function ($query) {
                $query->where('date', Carbon::now()->subDays(3)->format('Y-m-d'));
            })
            ->get();

        $applications->each(function ($application) {
            $application->notify(new FresqueApplicationFeedbackJ3());
            $this->count++;
        });

        if ($this->count > 0) {
            Notification::route('slack', config('services.slack.notifications.channel'))
                ->notify(new TaskSchedulingExecuted('[J+3] XXX, on a besoin de ton avis sur la Fresque du Bénévolat 💁🏻', $this->count));
        }
    }
}
