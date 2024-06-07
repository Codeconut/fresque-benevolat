<?php

namespace App\Console\Commands;

use App\Models\Fresque;
use App\Notifications\FresqueApplicationFeedbackJ3;
use App\Notifications\TaskSchedulingExecuted;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNotificationFeedbackJ3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notification-feedback-j-3 {fresqueId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification feedback J+3 for this fresque ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = 0;
        $fresque = Fresque::find($this->argument('fresqueId'));

        if (! $fresque) {
            $this->error('Fresque not found');

            return;
        }

        $query = $fresque->applications()->where('state', 'validated');

        if ($this->confirm($query->count().' notifications vont être envoyées pour la fresque du '.$fresque->full_date.' à '.$fresque->place->name.'. Voulez-vous continuer ?')) {
            $applications = $query->get();
            $applications->each(function ($application) use (&$count) {
                $application->notify(new FresqueApplicationFeedbackJ3());
                $count++;
            });

            if ($count > 0) {
                Notification::route('slack', config('services.slack.notifications.channel'))
                    ->notify(new TaskSchedulingExecuted('[J+3] XXX, on a besoin de ton avis sur la Fresque du Bénévolat 💁🏻', $count));
            }

            $this->info($count.' notifications ont été envoyées pour la fresque du '.$fresque->full_date.' à '.$fresque->place->name);
        }
    }
}
