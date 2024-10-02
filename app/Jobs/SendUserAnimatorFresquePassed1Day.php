<?php

namespace App\Jobs;

use App\Models\Fresque;
use App\Notifications\TaskSchedulingExecuted;
use App\Notifications\UserAnimatorFresquePassed1Day;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendUserAnimatorFresquePassed1Day implements ShouldQueue
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
        $passedFresques = Fresque::where('date', Carbon::now()->subDays(1)->format('Y-m-d'))->get();

        $passedFresques->each(function ($fresque) {
            if ($fresque->has('animators')) {
                $fresque->animators->each(function ($animator) use ($fresque) {
                    if ($animator->user) {
                        $animator->user->notify(new UserAnimatorFresquePassed1Day($fresque));
                        $this->count++;
                    }
                });
            }
        });

        if ($this->count > 0) {
            Notification::route('slack', config('services.slack.notifications.channel'))
                ->notify(new TaskSchedulingExecuted('Bravo pour ton animation ! La dernière étape pour mettre en valeur ta Fresque du Bénévolat !', $this->count));
        }
    }
}
