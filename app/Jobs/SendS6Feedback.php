<?php

namespace App\Jobs;

use App\Models\FresqueApplication;
use App\Notifications\FresqueApplicationFeedbackS6;
use App\Notifications\TaskSchedulingExecuted;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendS6Feedback implements ShouldQueue
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
        $applications = FresqueApplication::whereDoesntHave('feedback')->where('state', 'validated')->whereHas('fresque', function ($query) {
            $query->where('date', Carbon::now()->subWeeks(6)->format('Y-m-d'));
        })->get();

        $applications->each(function ($application) {
            $application->notify(new FresqueApplicationFeedbackS6());
            $this->count++;
        });

        if ($this->count > 0) {
            Notification::route('slack', config('services.slack.notifications.channel'))
                ->notify(new TaskSchedulingExecuted('[S+6] XXX, quelles sont les nouvelles depuis ta dernière Fresque du Bénévolat ?', $this->count));
        }
    }
}
