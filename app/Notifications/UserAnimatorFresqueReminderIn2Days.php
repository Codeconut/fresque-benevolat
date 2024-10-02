<?php

namespace App\Notifications;

use App\Models\Fresque;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAnimatorFresqueReminderIn2Days extends Notification implements ShouldQueue
{
    use Queueable;

    public string $tag = 'user-animator-fresque-reminder-in-2-days';

    /**
     * Create a new notification instance.
     */
    public function __construct(public Fresque $fresque) {}

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
        return (new MailMessage)
            ->subject($notifiable->first_name.', J-2 avant ton animation de la Fresque du Bénévolat ! 🙌')
            ->markdown('mail.animator.user-animator-fresque-reminder-in-2-days', [
                'url' => route('filament.admin.resources.fresques.view', ['record' => $this->fresque]),
                'fresque' => $this->fresque,
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
