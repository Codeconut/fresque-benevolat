<?php

namespace App\Jobs;

use App\Models\Fresque;
use App\Notifications\TaskSchedulingExecuted;
use App\Notifications\UserAnimatorFresqueReminderIn2Days;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendUserAnimatorReminderFresqueIn2Days implements ShouldQueue
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
        $incomingFresques = Fresque::where('date', Carbon::now()->addDays(2)->format('Y-m-d'))->get();

        $incomingFresques->each(function ($fresque) {
            if ($fresque->has('animators')) {
                $fresque->animators->each(function ($animator) use ($fresque) {
                    if ($animator->user) {
                        $animator->user->notify(new UserAnimatorFresqueReminderIn2Days($fresque));
                        $this->count++;
                    }
                });
            }
        });

        if ($this->count > 0) {
            Notification::route('slack', config('services.slack.notifications.channel'))
                ->notify(new TaskSchedulingExecuted('J-2 avant ton animation de la Fresque du Bénévolat ! 🙌', $this->count));
        }
    }
}
