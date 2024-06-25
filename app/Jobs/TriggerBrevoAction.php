<?php

namespace App\Jobs;

use App\Services\Brevo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TriggerBrevoAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $action, public array $attributes)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $brevo = new Brevo();

        if (config('services.brevo.sync_enabled') !== true) {
            return;
        }

        switch ($this->action) {
            case 'createOrUpdateContact':
                $brevo->createOrUpdateContact($this->attributes);
                break;
            default:
                throw new \Exception('Invalid action');
        }
    }
}
