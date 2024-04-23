<?php

namespace App\Notifications;

use App\Models\Fresque;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FresqueApplicationFeedbackJ3 extends Notification implements ShouldQueue
{
    use Queueable;

    public string $tag = 'fresque-application-feedback-j-3';

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        $fresque = $notifiable->fresque;

        return (new MailMessage)
            ->subject($notifiable->first_name . ', on a besoin de ton avis sur la Fresque du Bénévolat 💁🏻')
            ->markdown('mail.fresque-application.feedback-j-3', [
                'url' =>  route('fresques.applications.feedback', ['fresqueApplication' => $notifiable]),
                'fresque' =>  $fresque,
                'notifiable' => $notifiable,
            ])
            ->tag($this->tag);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
